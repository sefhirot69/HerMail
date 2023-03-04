<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PostSendMailController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([]);
    }
}
