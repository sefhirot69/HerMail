<?php

declare(strict_types=1);

namespace App\Controller\Dto;

final class AttachmentDto
{
    public function __construct(
        public string $name,
        public string $content,
    ) {
    }
}
