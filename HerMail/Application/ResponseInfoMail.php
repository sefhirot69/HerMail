<?php

declare(strict_types=1);

namespace HerMail\Application;

use HerMail\Domain\MailInfo\InfoMail;
use Shared\Domain\Bus\Command\CommandResponse;
use Shared\Domain\Bus\Query\QueryResponse;

final class ResponseInfoMail implements CommandResponse, \JsonSerializable, QueryResponse
{
    public function __construct(
        private readonly string $id,
        private readonly \DateTimeImmutable $startAt,
        private readonly ?\DateTimeImmutable $endAt,
        private readonly string $status,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function fromInfoMail(InfoMail $infoMail): self
    {
        return new self(
            (string) $infoMail->getId(),
            $infoMail->getDate()->getCreatedAt(),
            $infoMail->getDate()->getUpdatedAt(),
            $infoMail->getStatus()->value
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id'      => $this->id,
            'startAt' => $this->startAt->format(\DateTimeInterface::ATOM),
            'endAt'   => $this->endAt?->format(\DateTimeInterface::ATOM),
            'status'  => $this->status,
        ];
    }
}
