<?php

declare(strict_types=1);

namespace App\Controller;

use HerMail\Application\Command\InitTimerMailCommand;
use HerMail\Domain\Mail\Exceptions\MailSendException;
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
        /** @var SendMailDto $sendMailDto */
        $sendMailDto = $this->validateRequest($request, SendMailDto::class);

        $infoInitMail = $this->commandSyncBus->dispatch(new InitTimerMailCommand());

        $this->commandBus->dispatch($sendMailDto->mapToSendMailCommand());

        return new JsonResponse(null, Response::HTTP_ACCEPTED);
    }

    protected function exceptions(): array
    {
        return [
            ValidationFailedException::class => Response::HTTP_BAD_REQUEST,
            MailSendException::class         => 554,
        ];
    }
}
