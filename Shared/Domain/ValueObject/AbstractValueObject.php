<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

abstract class AbstractValueObject
{
    public function __construct(protected readonly string $value)
    {
    }

    abstract public function value(): mixed;

    public function isEqualTo(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
