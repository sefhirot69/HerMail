<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

class StringValueObject extends AbstractValueObject
{
    public function __toString(): string
    {
        return $this->value;
    }

    public function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}