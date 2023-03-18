<?php

declare(strict_types=1);

namespace HerMail\Domain\MailInfo;

final class Timestamp
{
    private function __construct(
        private readonly \DateTimeImmutable $createdAt,
        private ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    public static function initTimer(): self
    {
        return new self(new \DateTimeImmutable(), null);
    }

    public function endTimer(): self
    {
        return new self($this->getCreatedAt(), new \DateTimeImmutable());
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
