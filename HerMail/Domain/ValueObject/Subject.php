<?php

declare(strict_types=1);

namespace HerMail\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;

final class Subject extends StringValueObject
{
    public function __construct(protected string $value)
    {
        parent::__construct($this->value);
        $this->assertSubject();
    }

    public function assertSubject(): bool
    {
        if (empty($this->value())) {
            throw new \InvalidArgumentException('The email subject cannot be empty');
        }

        if (strlen($this->value()) > 255) {
            throw new \InvalidArgumentException('The email subject cannot be longer than 255 characters');
        }

        return true;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
