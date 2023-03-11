<?php

declare(strict_types=1);

namespace HerMail\Domain\ValueObject;

use Shared\Domain\ValueObject\StringValueObject;

final class Email extends StringValueObject
{
    public function __construct(protected readonly string $value)
    {
        parent::__construct($this->value);
        $this->assertEmail();
    }

    public function assertEmail(): bool
    {
        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid email address', $this));
        }

        return true;
    }
}
