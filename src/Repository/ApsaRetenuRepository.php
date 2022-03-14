<?php

namespace App\Repository;

use App\Entity\ApsaRetenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApsaRetenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApsaRetenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApsaRetenu[]    findAll()
 * @method ApsaRetenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApsaRetenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApsaRetenu::class);
    }

    // /**
    //  * @return ApsaRetenu[] Returns an array of ApsaRetenu objects
    //  */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->Join('a.apsa', 'a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneBySomeField($value): ?ApsaRetenu
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
