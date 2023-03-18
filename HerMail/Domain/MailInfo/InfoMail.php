<?php

declare(strict_types=1);

namespace HerMail\Domain\MailInfo;

use Ramsey\Uuid\UuidInterface;
use Shared\Domain\Aggregate\AggregateRoot;

final class InfoMail extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private Timestamp $date,
        private EmailStatus $status,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Timestamp $date,
        EmailStatus $status,
    ): self {
        return new self($id, $date, $status);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getDate(): Timestamp
    {
        return $this->date;
    }

    public function getStatus(): EmailStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->date->getCreatedAt();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->date->getUpdatedAt();
    }

    public function finish(): void
    {
        $timestamp = $this->getDate();
        $this->setStatus(EmailStatus::SENT);
        $this->setDate($timestamp->endTimer());
    }

    private function setDate(Timestamp $date): void
    {
        $this->date = $date;
    }

    private function setStatus(EmailStatus $status): void
    {
        $this->status = $status;
    }
}
