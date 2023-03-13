<?php

declare(strict_types=1);

namespace HerMail\Domain\MailInfo;

final class Timestamp
{
    private function __construct(
        private readonly ?\DateTimeImmutable $createdAt,
        private readonly ?\DateTimeImmutable $updatedAt,
    ) {
    }

    public static function initTime(): self
    {
        return new self(new \DateTimeImmutable(), null);
    }

    public static function endTime(): self
    {
        return new self(null, new \DateTimeImmutable());
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
