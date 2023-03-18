<?php

namespace HerMail\Infrastructure\Repository;

use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Repository\DoctrineRepository;

class DoctrineInfoMailRepository extends DoctrineRepository implements InfoMailRepositoryInterface
{
    public function save(InfoMail $infoMail): void
    {
        $this->persist($infoMail);
    }

    public function findById(UuidInterface $id): ?InfoMail
    {
        $infoMail = $this->getRepository(InfoMail::class)->find($id);

        return $infoMail instanceof InfoMail ? $infoMail : null;
    }
}
