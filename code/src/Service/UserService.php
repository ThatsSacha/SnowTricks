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
                            $token = $this->generateToken();
                            $user->setToken($token);
                            $user->setCreatedAt(date_create());

                            $this->emi->persist($user);
                            $this->emi->flush();

                            $this->mailerService->sendEmail($mail, $user->getPseudo() . ', valide ton compte !', $this->mailTemplate->getValidateAccount($user));
                        }
                    }
                }
            }
        }
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
}