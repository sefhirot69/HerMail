<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

abstract class StringValueObject extends AbstractValueObject
{
    public function __toString(): string
    {
        return $this->value;
    }

    abstract public static function fromString(string $value): self;

    public function value(): string
    {
        return $this->value;
    }
}
