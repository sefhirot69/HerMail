<?php

declare(strict_types=1);

namespace HerMail\Application\Query;

use HerMail\Application\ResponseInfoMail;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Bus\Query\QueryResponse;
use Shared\Domain\Exceptions\NotFoundException;

final class InfoMailQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly InfoMailRepositoryInterface $repository
    ) {
    }

    public function __invoke(InfoMailQuery $query): QueryResponse
    {
        $infoMail = $this->repository->findById(Uuid::fromString($query->getId()));

        if (null === $infoMail) {
            throw NotFoundException::entityWithId(InfoMail::class, $query->getId());
        }

        return ResponseInfoMail::fromInfoMail($infoMail);
    }
}
