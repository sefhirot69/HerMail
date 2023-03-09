<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Command;

use Faker\Factory;
use HerMail\Application\Command\SendMailCommand;

final class SendMailCommandMother
{
    public static function create(
        string $to,
        string $subject,
        string $body,
        ?array $attachments = null,
    ): SendMailCommand {
        return SendMailCommand::create($to, $subject, $body, $attachments);
    }

    public static function random(): SendMailCommand
    {
        return self::create(
            Factory::create()->email(),
            Factory::create()->realText(50),
            Factory::create()->text(),
            [], // TODO
        );
    }
}
