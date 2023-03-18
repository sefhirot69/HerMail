<?php

declare(strict_types=1);

namespace App\Controller;

use HerMail\Application\Query\InfoMailQuery;
use HerMail\Application\ResponseInfoMail;
use HerMail\Infrastructure\Controller\BaseController;
use Shared\Domain\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class StatusMailController extends BaseController
{
    public function __invoke(string $id): JsonResponse
    {
        /** @var ResponseInfoMail $response */
        $response = $this->queryBus->ask(InfoMailQuery::create($id));

        return new JsonResponse($response, Response::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [
            NotFoundException::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
