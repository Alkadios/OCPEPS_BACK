<?php

namespace App\Repository;

use App\Entity\Apsa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apsa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apsa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apsa[]    findAll()
 * @method Apsa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApsaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apsa::class);
    }

    // /**
    //  * @return Apsa[] Returns an array of Apsa objects
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
    public function findOneBySomeField($value): ?Apsa
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
