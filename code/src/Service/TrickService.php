<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Service\TrickGroupService;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;

class TrickService {
    private $emi;
    private $repo;
    private TrickGroupService $trickGroupService;

    public function __construct(TrickRepository $repo, EntityManagerInterface $emi, TrickGroupService $trickGroupService) {
        $this->emi = $emi;
        $this->repo = $repo;
        $this->trickGroupService = $trickGroupService;
    }

    /**
     * This function veriy if in the trickMedia collection, if one image is filled up at least. It retrurns Trick if it's ok, else it returns false.
     * 
     * @param Trick $trick
     * 
     * @return Trick|bool
     */
    private function verifyAndPersistTrickMedia(Trick $trick): Trick|bool {
        $hasImg = false;

        foreach ($trick->getTrickMedia() as $trickMedia) {
            if ($trickMedia->getIsImg() && !empty($trickMedia->getUrl())) {
                $hasImg = true;
            }

            $this->emi->persist($trickMedia);
        }

        return $hasImg ? $trick : false;
    }

    /**
     * @param Trick $trick
     */
    public function edit(Trick $trick) {
        $trick = $this->verifyAndPersistTrickMedia($trick);

        if ($trick instanceof Trick) {
            $this->emi->persist($trick);
            $this->emi->flush();
    
            return $this->findOneBySlug($trick->getSlug());
        }

        return [
            'isError' => true,
            'type' => 'error',
            'message' => 'Vous devez ajouter au moins une image à votre trick.',
        ];
    }

    /**
     * @param Trick $trick
     * @param User $user
     */
    public function new(Trick $trick, User $user) {
        $trick = $this->verifyAndPersistTrickMedia($trick);
        
        if ($trick instanceof Trick) {
            $name = $trick->getName();
            $trickData = $this->repo->findOneBy(array('name' => $name));
    
            if ($trickData === null) {
                $slug = $this->generateSlug($trick->getName());
    
                $trick->setCreatedAt(date_create())
                    ->setCreatedBy($user)
                    ->setSlug($slug);
    
                $this->emi->persist($trick);
                $this->emi->flush();
    
                return $this->findOneBySlug($slug);
            }
        }

        return [
            'isError' => true,
            'type' => 'error',
            'message' => 'Vous devez ajouter au moins une image à votre trick.',
        ];
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

    public function getTrickGroups() {
       return $this->trickGroupService->findAll();
    }

    public function findOneBySlug(string $slug) {
        return $this->repo->findOneBy(array('slug' => $slug));
    }
}