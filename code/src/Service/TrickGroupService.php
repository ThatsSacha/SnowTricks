<?php

namespace App\Service;

use App\Entity\TrickGroup;
use App\Repository\TrickGroupRepository;
use Doctrine\ORM\EntityManagerInterface;

class TrickGroupService {
    private $emi;
    private $repo;

    public function __construct(TrickGroupRepository $repo, EntityManagerInterface $emi) {
        $this->emi = $emi;
        $this->repo = $repo;
    }

    /**
     * @return TrickGroup[]
     */
    public function findAll(): array {
        return $this->repo->findAll();
    }
}