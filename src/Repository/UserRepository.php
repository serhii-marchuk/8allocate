<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }
}