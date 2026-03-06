<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/Entity'],
    isDevMode: (getenv('APP_ENV') ?? 'dev') === 'dev',
);

$connection = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => getenv('DB_HOST'),
    'dbname'   => getenv('DB_NAME'),
    'user'     => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset'  => 'utf8mb4',
], $config);

return new EntityManager($connection, $config);

