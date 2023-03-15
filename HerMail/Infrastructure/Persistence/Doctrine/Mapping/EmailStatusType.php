<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Persistence\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use HerMail\Domain\MailInfo\EmailStatus;

final class EmailStatusType extends StringType
{
    public function getName(): string
    {
        return 'status_type';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof EmailStatus) {
            throw new \InvalidArgumentException(sprintf('Invalid value \'%s\'', $value));
        }

        return $value->value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): EmailStatus
    {
        return EmailStatus::from($value);
    }
}
