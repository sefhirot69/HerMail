<?php

declare(strict_types=1);

namespace HerMail\Application\Command;

use Shared\Domain\Bus\Command\Command;

final class SendMailCommand implements Command
{
    public function __construct()
    {
    }
}