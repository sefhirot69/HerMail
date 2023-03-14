<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Mail;

use HerMail\Domain\Mail\Exceptions\MailSendException;
use HerMail\Domain\Mail\MailerInterface;
use HerMail\Domain\Mail\MailParameter;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\Email;

final class SymfonyMailer implements MailerInterface
{
    public function __construct(
        private readonly SymfonyMailerInterface $mailer
    ) {
    }

    public function send(MailParameter $mail): void
    {
        try {
            $email = new Email();
            $email->from((string) $mail->getSender())
                ->to((string) $mail->getRecipient())
                ->subject((string) $mail->getSubject())
                ->text((string) $mail->getBody());
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw MailSendException::fromThrowable($e);
        }
    }
}
