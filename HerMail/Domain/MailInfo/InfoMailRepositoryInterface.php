<?php

namespace HerMail\Domain\MailInfo;

use Ramsey\Uuid\UuidInterface;

interface InfoMailRepositoryInterface
{
    public function save(InfoMail $infoMail): void;

    public function findById(UuidInterface $id): ?InfoMail;
}
