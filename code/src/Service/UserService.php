<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService {
    private $emi;
    private $repo;
    private $passwordHasher;

    public function __construct(UserRepository $repo, EntityManagerInterface $emi, UserPasswordHasherInterface $passwordHasher) {
        $this->emi = $emi;
        $this->repo = $repo;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param User $user
     */
    public function new(User $user) {
        $mail = $user->getEmail();
        $pseudo = $user->getPseudo();

        if (!empty($mail) && !empty($pseudo)) {
            $users = $this->repo->findBy(array('email' => $mail, 'pseudo' => $pseudo));

            if (count($users) === 0) {
                $cover = $this->verifyAndRenameCover($user);
                $password = $user->getPassword();
                $isPasswordValid = $this->isPasswordValid($password);

                if ($isPasswordValid) {
                    $password = $this->passwordHasher->hashPassword($user, $password);
                    $user->setPassword($password);
                    $this->emi->persist($user);
                    $this->emi->flush();
                }
            }
        }
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
     * @param User $user
     * 
     * @return string
     */
    public function verifyAndRenameCover(User $user): string {
        $cover = $user->getCover();

        if (!empty($cover)) {
            $isExtensionAuthorized = $this->isExtensionAuthorized($cover);
        }

        return '';
    }

    /**
     * @param FileUpload $cover
     */
    public function isExtensionAuthorized($cover) {
        dd($cover->guessExtension());
        $authorizedExtensions = array('jpg', 'jpeg', 'png');
        $extension = $cover->guessExtension();
        dd($extension);
    }
}