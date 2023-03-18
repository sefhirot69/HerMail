<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use HerMail\Domain\MailInfo\EmailStatus;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use HerMail\Domain\MailInfo\Timestamp;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Bus\Command\CommandResponse;
use Shared\Domain\Bus\Command\CommandSyncHandler;

final class InitTimerMailCommandHandler implements CommandSyncHandler
{
    public function __construct(
        private readonly InfoMailRepositoryInterface $repository,
    ) {
    }

    public function __invoke(InitTimerMailCommand $command): CommandResponse
    {
        $infoMail = InfoMail::create(
            Uuid::uuid7(),
            Timestamp::initTimer(),
            EmailStatus::QUEUED
        );

        $this->repository->save($infoMail);

        return ResponseInitTimer::fromInfoMail($infoMail);
    }
}
