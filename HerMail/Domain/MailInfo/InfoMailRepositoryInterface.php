<?php

namespace HerMail\Domain\MailInfo;

interface InfoMailRepositoryInterface
{
    public function save(InfoMail $infoMail): void;
}
