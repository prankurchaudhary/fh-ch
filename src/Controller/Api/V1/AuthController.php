<?php

namespace App\Controller\Api\V1;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    #[Route('/api/v1/login', name: 'api_v1_login', methods: ['POST'])]
    public function login(): void
    {
         throw new \LogicException('This method should never be reached.');
    }
}