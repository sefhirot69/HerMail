<?php

namespace HerMail\Domain\Mail;

interface MailerInterface
{
    public function send(MailParameter $mail): void;
}
