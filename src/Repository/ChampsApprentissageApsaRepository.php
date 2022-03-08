<?php

namespace App\Repository;

use App\Entity\ChampsApprentissageApsa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChampsApprentissageApsa|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChampsApprentissageApsa|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChampsApprentissageApsa[]    findAll()
 * @method ChampsApprentissageApsa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampsApprentissageApsaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChampsApprentissageApsa::class);
    }

    // /**
    //  * @return ChampsApprentissageApsa[] Returns an array of ChampsApprentissageApsa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChampsApprentissageApsa
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
