<?php

declare(strict_types=1);

namespace HerMail\Domain\Mail\Exceptions;

final class MailSendException extends \RuntimeException
{
    public static function fromThrowable(\Throwable $throwable): self
    {
        return new self($throwable->getMessage());
    }
}
