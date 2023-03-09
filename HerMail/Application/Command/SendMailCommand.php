<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use Shared\Domain\Bus\Command\Command;

final class SendMailCommand implements Command
{
    private function __construct(
        private readonly string $to,
        private readonly string $subject,
        private readonly string $body,
        /**
         * @var ?array<int, AttachmentCommand>
         */
        private readonly ?array $attachments = null
    ) {
    }

    public static function create(
        string $to,
        string $subject,
        string $body,
        ?array $attachments = null,
    ): self {
        return new self($to, $subject, $body, $attachments);
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return ?array<int, AttachmentCommand>
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }
}
