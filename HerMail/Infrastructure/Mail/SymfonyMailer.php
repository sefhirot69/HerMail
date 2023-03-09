<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Mail;

use HerMail\Domain\Mail\MailerInterface;

final class SymfonyMailer implements MailerInterface
{
    public function send(string $to, string $subject, string $body, ?array $attachment = []): void
    {
        // TODO: Implement send() method.
    }
}
