<?php

namespace App;

use App\Entity\User;

class Router
{
    public function dispatch(string $requestUri, array $data): void
    {
        header('Content-Type: application/json');

        try {
            if ($requestUri === '/hello-world') {
                $this->helloWorld($data);
                return;
            }
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

        http_response_code(404);
        echo json_encode(['error' => '404 Not Found']);
    }

    private function helloWorld(array $data = []): void
    {
        $data = array_map(fn(User $user) => [
            'id' => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'age' => $user->getAge(),
            'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ], $data);

        http_response_code(200);
        echo json_encode($data);
    }
}