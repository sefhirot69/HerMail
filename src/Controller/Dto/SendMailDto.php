<?php

declare(strict_types=1);

namespace App\Controller\Dto;

final class SendMailDto
{
    public function __construct(
        public string $to,
        public string $subject,
        public string $body,
        /**
         * @var ?array<int, AttachmentDto>
         */
        public ?array $attachments = null,
    ) {
    }
}
