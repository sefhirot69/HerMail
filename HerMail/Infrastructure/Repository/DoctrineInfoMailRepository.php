<?php

namespace HerMail\Infrastructure\Repository;

use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use Shared\Infrastructure\Repository\DoctrineRepository;

class DoctrineInfoMailRepository extends DoctrineRepository implements InfoMailRepositoryInterface
{
    public function save(InfoMail $infoMail): void
    {
        $this->persist($infoMail);
    }
}
