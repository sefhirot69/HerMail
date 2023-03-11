<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use HerMail\Domain\Mail\Mail;
use HerMail\Domain\Mail\MailerInterface;
use HerMail\Domain\Mail\Recipient;
use HerMail\Domain\Mail\Sender;
use HerMail\Domain\ValueObject\Body;
use HerMail\Domain\ValueObject\Subject;
use Shared\Domain\Bus\Command\CommandHandler;

final class SendMailCommandHandler implements CommandHandler
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(SendMailCommand $command): void
    {
        $mailParameter = Mail::create(
            Recipient::fromString($command->getTo()),
            Sender::fromString('no-reply@gmai.com'),
            Subject::fromString($command->getSubject()),
            Body::fromString($command->getBody()),
            null
        );

        $this->mailer->send($mailParameter);
    }
}
