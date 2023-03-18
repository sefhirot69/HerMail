<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use HerMail\Domain\MailInfo\EmailStatus;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\Timestamp;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class InfoMailMother
{
    public static function create(
        UuidInterface $id,
        Timestamp $date,
        EmailStatus $status,
    ): InfoMail {
        return InfoMail::create($id, $date, $status);
    }

    public static function initTimer(): InfoMail
    {
        return self::create(
            Uuid::uuid7(),
            TimestampMother::initTimer(),
            EmailStatus::QUEUED,
        );
    }

    public static function endTimer(): InfoMail
    {
        return self::create(
            Uuid::uuid7(),
            TimestampMother::endTimer(),
            EmailStatus::SENT,
        );
    }
}
