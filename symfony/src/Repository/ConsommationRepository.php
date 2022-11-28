<?php

namespace App\Repository;

use App\Entity\Consommation;
use App\Entity\Foyer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Consommation>
 *
 * @method Consommation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consommation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consommation[]    findAll()
 * @method Consommation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consommation::class);
    }

    public function save(Consommation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Consommation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getConsoOfTheDay(Foyer $foyer, string $date): Consommation
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where($qb->expr()->andX(
                $qb->expr()->eq('c.csm_foyer',':foyer'),
                $qb->expr()->eq('c.csm_date',':date'),
            ))
            ->setParameter('foyer', $foyer->getId())
            ->setParameter('date', $date);

        return $qb->getQuery()->getSingleResult();
    }

}
