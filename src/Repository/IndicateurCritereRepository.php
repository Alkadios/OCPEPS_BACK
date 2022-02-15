<?php

namespace App\Repository;

use App\Entity\IndicateurCritere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IndicateurCritere|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndicateurCritere|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndicateurCritere[]    findAll()
 * @method IndicateurCritere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndicateurCritereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndicateurCritere::class);
    }

    // /**
    //  * @return IndicateurCritere[] Returns an array of IndicateurCritere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndicateurCritere
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
