<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use HerMail\Domain\Mail\MailerInterface;
use HerMail\Domain\Mail\MailParameter;
use HerMail\Domain\Mail\Recipient;
use HerMail\Domain\Mail\Sender;
use HerMail\Domain\MailInfo\EmailStatus;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use HerMail\Domain\MailInfo\Timestamp;
use HerMail\Domain\ValueObject\Body;
use HerMail\Domain\ValueObject\Subject;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Bus\Command\CommandHandler;

final class SendMailCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly InfoMailRepositoryInterface $repository,
        private readonly MailerInterface $mailer
    ) {
    }

    public function __invoke(SendMailCommand $command): void
    {
        $infoMail = InfoMail::create(
            Uuid::uuid7(),
            Timestamp::initTime(),
            EmailStatus::NOT_SENT
        );

        $this->repository->save($infoMail);

        $mailParameter = MailParameter::create(
            Recipient::fromString($command->getTo()),
            Sender::fromString('no-reply@gmai.com'),
            Subject::fromString($command->getSubject()),
            Body::fromString($command->getBody()),
            null
        );

        $this->mailer->send($mailParameter);
    }
}
