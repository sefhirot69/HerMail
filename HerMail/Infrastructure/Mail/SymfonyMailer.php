<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Mail;

use HerMail\Domain\Mail\Mail;
use HerMail\Domain\Mail\MailerInterface;

final class SymfonyMailer implements MailerInterface
{
    public function send(Mail $mail): void
    {
        // TODO: Implement send() method.
    }
}
