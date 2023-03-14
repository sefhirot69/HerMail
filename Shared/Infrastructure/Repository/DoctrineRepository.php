<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Shared\Domain\Aggregate\AggregateRoot;

class DoctrineRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function getRepository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
