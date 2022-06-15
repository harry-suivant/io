<?php

namespace App\Repository;

use App\Entity\RoadmapCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoadmapCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoadmapCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoadmapCheck[]    findAll()
 * @method RoadmapCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoadmapCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoadmapCheck::class);
    }

    // /**
    //  * @return RoadmapCheck[] Returns an array of RoadmapCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoadmapCheck
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
