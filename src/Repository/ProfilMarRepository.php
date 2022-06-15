<?php

namespace App\Repository;

use App\Entity\ProfilMarketing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilMarketing|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilMarketing|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilMarketing[]    findAll()
 * @method ProfilMarketing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilMarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilMarketing::class);
    }

    // /**
    //  * @return ProfilMarketing[] Returns an array of ProfilMarketing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProfilMarketing
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
