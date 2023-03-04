<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class SendMailController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse([]);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
