<?php

declare(strict_types=1);

namespace HerMail\Application\Query;

use Shared\Domain\Bus\Query\Query;

final class InfoMailQuery implements Query
{
    private function __construct(private readonly string $id)
    {
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
