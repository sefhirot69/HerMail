<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use HerMail\Domain\Mail\MailerInterface;
use Shared\Domain\Bus\Command\CommandHandler;

final class SendMailCommandHandler implements CommandHandler
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(SendMailCommand $command): void
    {
        $this->mailer->send(
            $command->getTo(),
            $command->getSubject(),
            $command->getBody(),
            $command->getAttachments()
        );
    }
}
