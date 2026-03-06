<?php

use App\Router;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class App
{
    private Router $router;
    private EntityManager $entityManager;
    private string $requestUri;

    public function __construct(EntityManager $entityManager)
    {
        $this->requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->entityManager = $entityManager;
        $this->router = new Router();
    }

    public function handleRequest(): void
    {
        $repository = new UserRepository($this->entityManager);
        $this->router->dispatch($this->requestUri, $repository->getAll());
    }
}