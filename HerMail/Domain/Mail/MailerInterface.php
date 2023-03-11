<?php

namespace HerMail\Domain\Mail;

interface MailerInterface
{
    public function send(Mail $mail): void;
}
