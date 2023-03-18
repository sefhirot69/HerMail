<?php

declare(strict_types=1);

namespace HerMail\Domain\Mail;

use HerMail\Domain\ValueObject\Email;

final class Sender extends Email
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
