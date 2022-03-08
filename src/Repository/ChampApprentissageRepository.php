<?php

namespace App\Repository;

use App\Entity\ChampApprentissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChampApprentissage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChampApprentissage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChampApprentissage[]    findAll()
 * @method ChampApprentissage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampApprentissageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChampApprentissage::class);
    }

    // /**
    //  * @return ChampApprentissage[] Returns an array of ChampApprentissage objects
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
    public function findOneBySomeField($value): ?ChampApprentissage
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
