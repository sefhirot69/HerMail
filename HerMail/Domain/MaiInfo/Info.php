<?php

declare(strict_types=1);

namespace HerMail\Domain\MaiInfo;

use Ramsey\Uuid\UuidInterface;

final class Info
{
    private function __construct(
        private readonly UuidInterface $id,
        private readonly Timestamp $date,
        private readonly EmailStatus $status,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Timestamp $date,
        EmailStatus $status,
    ): self {
        return new self($id, $date, $status);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Timestamp
     */
    public function getDate(): Timestamp
    {
        return $this->date;
    }

    /**
     * @return EmailStatus
     */
    public function getStatus(): EmailStatus
    {
        return $this->status;
    }
}