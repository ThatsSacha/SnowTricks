<?php

namespace App\Service;

use App\Entity\Trick;
use App\Entity\User;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;

class TrickService {
    private $emi;
    private $repo;

    public function __construct(TrickRepository $repo, EntityManagerInterface $emi) {
        $this->emi = $emi;
        $this->repo = $repo;
    }

    /**
     * @param Trick $trick
     * @param User $user
     */
    public function new(Trick $trick, User $user) {
        $name = $trick->getName();
        $trickData = $this->repo->findOneBy(array('name' => $name));
        $response = array();

        if ($trickData === null) {
            $slug = $this->generateSlug($trick->getName());

            $trick->setCreatedAt(date_create())
                ->setCreatedBy($user)
                ->setSlug($slug);

            $this->emi->persist($trick);
            $this->emi->flush();
        } else {
            $response[] = 'Le trick existe déjà';
        }
        
        return $response;
    }

    /**
     * @param string $slug
     * 
     * @return string
     */
    public function generateSlug(string $slug): string {
        $slug = str_replace(' ', '-', $slug);
        $slug = strtolower($slug);

        return $slug;
    }
}