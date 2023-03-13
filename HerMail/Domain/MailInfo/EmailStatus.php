<?php

declare(strict_types=1);

namespace HerMail\Domain\MailInfo;

enum EmailStatus: string
{
    case NOT_SENT   = 'not_sent';
    case QUEUED     = 'queued';
    case SENT       = 'sent';
    case SEND_ERROR = 'send_error';
}
