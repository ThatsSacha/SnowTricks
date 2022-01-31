<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService {
    private $emi;
    private $repo;
    private $passwordHasher;
    private $mailTemplate;
    private $mailerService;

    public function __construct(UserRepository $repo, EntityManagerInterface $emi, UserPasswordHasherInterface $passwordHasher, MailTemplateService $mailTemplate, MailerService $mailerService) {
        $this->emi = $emi;
        $this->repo = $repo;
        $this->passwordHasher = $passwordHasher;
        $this->mailTemplate = $mailTemplate;
        $this->mailerService = $mailerService;
    }

    /**
     * @param User $user
     * @param Request $request
     */
    public function new(User $user, Request $request) {
        $mail = $user->getEmail();
        $pseudo = $user->getPseudo();

        if (!empty($mail) && !empty($pseudo)) {
            $isMailValid = filter_var($mail, FILTER_VALIDATE_EMAIL);
            
            if ($isMailValid) {
                $usersByMail = $this->repo->findBy(array('email' => $mail));
                $usersByPseudo = $this->repo->findBy(array('pseudo' => $pseudo));
                
                if (count($usersByMail) === 0 && count($usersByPseudo) === 0) {
                    $password = $user->getPassword();
                    $isPasswordValid = $this->isPasswordValid($password);
                    
                    if ($isPasswordValid) {
                        $password = $this->passwordHasher->hashPassword($user, $password);
                        $user->setPassword($password);
    
                        $cover = $request->files->get('user')['cover'];
                        $cover = $this->verifyAndRenameCover($cover);
                        
                        if ($cover !== null) {
                            $user->setCover($cover);
                            $user->setCreatedAt(date_create());

                            $user = $this->saveObject($user);

                            if ($user !== null) {
                                $this->validateAccountProcess($user);
                            } else {
                                return [
                                    'isError' => true,
                                    'type' => 'error',
                                    'message' => 'Cet utilisateur n\'a pas pu être créé.'
                                ];
                            }
                        } else {
                            return [
                                'isError' => true,
                                'type' => 'error',
                                'message' => 'Cette extension de fichier n\'est pas autorisée'
                            ];
                        }
                    } else {
                        return [
                            'isError' => true,
                            'type' => 'error',
                            'message' => 'Le mot de passe doit contenir minimum 8 caractères et au moins 1 chiffre'
                        ];
                    }
                }
            }
        }
    }

    /**
     * This function flush to db and return the user object
     * 
     * @param User $user
     * 
     * @return User
     */
    private function saveObject(User $user): User {
        $this->emi->persist($user);
        $this->emi->flush();
        return $this->repo->findOneBy(array('id' => $user->getId()));
    }

    public function validateAccountProcess(User $user) {
        $token = $this->generateToken();
        $user->setToken($token);
        $this->emi->persist($user);
        $this->emi->flush();

        $this->mailerService->sendEmail(
            $user->getEmail(),
            $user->getPseudo() . ', valide ton compte !',
            $this->mailTemplate->getValidateAccount($user)
        );
    }

    /**
     * @return string
     */
    private function generateToken(): string {
        $token = hash('sha512', random_bytes(32) . time());
        return $token;
    }

    /**
     * @param string $password
     * 
     * @return bool
     */
    public function isPasswordValid(string $password): bool {
        $isPasswordLengthValid = strlen($password) >= 8;
        $isPasswordContainsNumber = preg_match('/[0-9]/', $password);

        if ($isPasswordLengthValid && $isPasswordContainsNumber) {
            return true;
        }

        return false;
    }

    /**
     * @param UploadedFile $file
     * 
     * @return string|null
     */
    public function verifyAndRenameCover(UploadedFile $file): string|null {
        $isExtensionAuthorized = $this->isExtensionAuthorized($file);

        if ($isExtensionAuthorized) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move('../public/img/users', $fileName);

            return $fileName;
        }

        return null;
    }

    /**
     * @param UploadedFile $file
     */
    public function isExtensionAuthorized(UploadedFile $file) {
        $authorizedExtensions = array('jpg', 'jpeg', 'png');
        $extension = $file->guessExtension();
        
        if (in_array($extension, $authorizedExtensions)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $token
     * 
     * @return bool
     */
    public function validateAccount(string $token): bool {
        $user = $this->repo->findOneBy(array('token' => $token));

        if ($user !== null) {
            $user->setToken(null)
                ->setIsAccountConfirmed(true);

            $this->emi->persist($user);
            $this->emi->flush();

            return true;
        }

        return false;
    }

    /**
     * @param string $mail
     */
    public function sendResetPassword(string $mail) {
        $user = $this->repo->findOneBy(array('email' => $mail));

        if ($user !== null) {
            $token = $this->generateToken();
            $user->setToken($token);

            $this->emi->persist($user);
            $this->emi->flush();

            $this->mailerService->sendEmail($mail, 'Réinitialise ton mot de passe', $this->mailTemplate->getResetPassword($user));
        }
    }

    /**
     * @param string $token
     */
    public function verifyResetPassword(string $token) {
        $user = $this->repo->findOneBy(array('token' => $token));

        if ($user !== null) {
            $token = $this->generateToken();
            $user->setToken($token);

            $this->emi->persist($user);
            $this->emi->flush();

            return $token;
        }
    }

    /**
     * @param Request $request
     */
    public function setPassword(Request $request) {
        $token = $request->get('token');
        $user = $this->repo->findOneBy(array('token' => $token));
        $error = null;

        if ($user !== null) {
            $user->setToken(null);

            $password = $request->get('password');
            $isPasswordValid = $this->isPasswordValid($password);

            if ($isPasswordValid) {
                $password = $this->passwordHasher->hashPassword($user, $password);
                $user->setPassword($password);

                $this->emi->persist($user);
                $this->emi->flush();

                $error = null;
            } else {
                $error = 'Le format du mot de passe est erroné';
            }
        } else {
            $error = 'Le token est invalide';
        }

        return $error;
    }
}