<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use HerMail\Domain\MailInfo\Timestamp;

final class TimestampMother
{
    public static function initTimer(): Timestamp
    {
        return Timestamp::initTimer();
    }

    public static function endTimer(): Timestamp
    {
        return Timestamp::initTimer()->endTimer();
    }
}
