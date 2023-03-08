<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

final class AttachmentCommand
{
    private function __construct(
        private readonly string $filename,
        private readonly string $content,
    ) {
    }

    public static function create(
        string $filename,
        string $content,
    ): self {
        return new self($filename, $content);
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
