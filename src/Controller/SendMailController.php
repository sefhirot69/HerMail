<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Dto\SendMailDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class SendMailController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        $sendMailDto = $this->deserialize($request->getContent(), SendMailDto::class);

        return new JsonResponse([]);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
