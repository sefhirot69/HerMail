<?php

declare(strict_types=1);

namespace HerMail\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;

class Email extends StringValueObject
{
    public function __construct(protected string $value)
    {
        parent::__construct($value);
        $this->assertEmail();
    }

    public function assertEmail(): bool
    {
        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid email address', $this));
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
