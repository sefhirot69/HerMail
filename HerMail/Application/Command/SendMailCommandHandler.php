<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use Shared\Domain\Bus\Command\CommandHandler;

final class SendMailCommandHandler implements CommandHandler
{
    public function __invoke(SendMailCommand $command): void
    {
        $test = '';
    }
}