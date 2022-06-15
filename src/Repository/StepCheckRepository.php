<?php

namespace App\Repository;

use App\Entity\StepCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StepCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method StepCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method StepCheck[]    findAll()
 * @method StepCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StepCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StepCheck::class);
    }

    // /**
    //  * @return StepCheck[] Returns an array of StepCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StepCheck
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
