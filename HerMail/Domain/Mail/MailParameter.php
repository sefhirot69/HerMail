<?php

declare(strict_types=1);

namespace HerMail\Domain\Mail;

use HerMail\Domain\ValueObject\Body;
use HerMail\Domain\ValueObject\Email;
use HerMail\Domain\ValueObject\Subject;

final class MailParameter
{
    private function __construct(
        private readonly Recipient $recipient,
        private readonly Sender $sender,
        private readonly Subject $subject,
        private readonly Body $body,
        /**
         * @var ?array<int, Attachment>
         */
        private readonly ?array $attachment = null
    ) {
    }

    public static function create(
        Recipient $recipient,
        Sender $sender,
        Subject $subject,
        Body $body,
        ?array $attachment = null
    ): self {
        return new self($recipient, $sender, $subject, $body, $attachment);
    }

    public function getRecipient(): Email
    {
        return $this->recipient;
    }

    public function getSender(): Email
    {
        return $this->sender;
    }

    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function getBody(): Body
    {
        return $this->body;
    }

    public function getAttachment(): ?array
    {
        return $this->attachment;
    }
}
