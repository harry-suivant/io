<?php

namespace App\Repository;

use App\Entity\ProfilCommercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilCommercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilCommercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilCommercial[]    findAll()
 * @method ProfilCommercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilComRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilCommercial::class);
    }

    // /**
    //  * @return ProfilCommercial[] Returns an array of ProfilCommercial objects
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
    public function findOneBySomeField($value): ?ProfilCommercial
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
