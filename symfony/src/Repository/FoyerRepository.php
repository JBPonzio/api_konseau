<?php

namespace App\Repository;

use App\Entity\Foyer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Foyer>
 *
 * @method Foyer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Foyer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Foyer[]    findAll()
 * @method Foyer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoyerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Foyer::class);
    }

    public function save(Foyer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Foyer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
