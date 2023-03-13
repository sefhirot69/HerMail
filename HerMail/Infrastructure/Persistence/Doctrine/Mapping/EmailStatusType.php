<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Persistence\Doctrine\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use HerMail\Domain\MaiInfo\EmailStatus;

final class EmailStatusType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value instanceof EmailStatus) {
            throw new \InvalidArgumentException(sprintf('Invalid value \'%s\'', $value));
        }

        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return EmailStatus::from($value);
    }
}
