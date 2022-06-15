<?php

namespace App\Repository;

use App\Entity\ActionCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActionCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionCheck[]    findAll()
 * @method ActionCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionCheck::class);
    }

    // /**
    //  * @return ActionCheck[] Returns an array of ActionCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActionCheck
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
