<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use HerMail\Domain\Mail\MailerInterface;
use HerMail\Domain\Mail\MailParameter;
use HerMail\Domain\Mail\Recipient;
use HerMail\Domain\Mail\Sender;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use HerMail\Domain\ValueObject\Body;
use HerMail\Domain\ValueObject\Subject;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Bus\Command\CommandHandler;

final class SendMailCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly InfoMailRepositoryInterface $repository,
    ) {
    }

    public function __invoke(SendMailCommand $command): void
    {
        /** @var InfoMail $infoMail */
        $infoMail = $this->repository->findById(Uuid::fromString($command->getIdInfo()));

        $mailParameter = MailParameter::create(
            Recipient::fromString($command->getTo()),
            Sender::fromString('no-reply@gmai.com'),
            Subject::fromString($command->getSubject()),
            Body::fromString($command->getBody()),
            null
        );

        $this->mailer->send($mailParameter);

        $infoMail->finish();

        $this->repository->save($infoMail);
    }
}
