<?php

declare(strict_types=1);

namespace HerMail\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;

final class Body extends StringValueObject
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
