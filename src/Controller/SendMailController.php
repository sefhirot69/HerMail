<?php

declare(strict_types=1);

namespace App\Controller;

use HerMail\Application\Command\SendMailCommand;
use HerMail\Infrastructure\Controller\BaseController;
use HerMail\Infrastructure\Controller\Dto\SendMailDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class SendMailController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        $sendMailDto = $this->validateRequest($request, SendMailDto::class);

        $this->commandBus->dispatch(new SendMailCommand());

        return new JsonResponse([]);
    }

    protected function exceptions(): array
    {
        return [
            ValidationFailedException::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
