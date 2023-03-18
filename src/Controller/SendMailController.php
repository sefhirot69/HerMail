<?php

declare(strict_types=1);

namespace App\Controller;

use HerMail\Application\Command\InitTimerMailCommand;
use HerMail\Application\Command\ResponseInitTimer;
use HerMail\Domain\Mail\Exceptions\MailSendException;
use HerMail\Infrastructure\Controller\BaseController;
use HerMail\Infrastructure\Controller\Dto\SendMailDto;
use Shared\Domain\Exceptions\NotFoundException;
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

        /** @var ResponseInitTimer $infoInitMail */
        $infoInitMail = $this->commandSyncBus->dispatch(new InitTimerMailCommand());

        $this->commandBus->dispatch($sendMailDto->mapToSendMailCommand($infoInitMail->getId()));

        return new JsonResponse($infoInitMail, Response::HTTP_ACCEPTED);
    }

    protected function exceptions(): array
    {
        return [
            ValidationFailedException::class => Response::HTTP_BAD_REQUEST,
            NotFoundException::class         => Response::HTTP_NOT_FOUND,
            MailSendException::class         => 554,
            \Exception::class                => Response::HTTP_INTERNAL_SERVER_ERROR,
        ];
    }
}
