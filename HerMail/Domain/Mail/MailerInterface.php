<?php

namespace HerMail\Domain\Mail;

interface MailerInterface
{
    public function send(string $to, string $subject, string $body, ?array $attachment = []): void;
}
