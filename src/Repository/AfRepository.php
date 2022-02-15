<?php

namespace App\Repository;

use App\Entity\Af;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Af|null find($id, $lockMode = null, $lockVersion = null)
 * @method Af|null findOneBy(array $criteria, array $orderBy = null)
 * @method Af[]    findAll()
 * @method Af[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Af::class);
    }

    // /**
    //  * @return Af[] Returns an array of Af objects
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
    public function findOneBySomeField($value): ?Af
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
