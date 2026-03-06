<?php

use App\Entity\User;

/** @var \Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once __DIR__ . '/src/bootstrap.php';

$firstNames = ['John', 'Jane', 'Bob', 'Alice', 'Charlie', 'Diana', 'Eve', 'Frank', 'Grace', 'Henry'];
$lastNames = ['Doe', 'Smith', 'Brown', 'White', 'Black', 'Green', 'Blue', 'Grey', 'Taylor', 'Wilson'];

echo "Seeding users...\n";

for ($i = 0; $i < 10; $i++) {
    $user = new User();
    $user->setFirstName($firstNames[$i]);
    $user->setLastName($lastNames[$i]);
    $user->setAge(rand(18, 60));
    $user->setCreatedAt(new \DateTime("-" . rand(0, 365) . " days"));

    $entityManager->persist($user);
}

$entityManager->flush();

echo "Seeded 10 users successfully!\n";
