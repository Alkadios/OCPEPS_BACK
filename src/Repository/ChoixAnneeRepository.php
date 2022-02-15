<?php

namespace App\Repository;

use App\Entity\ChoixAnnee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChoixAnnee|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoixAnnee|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoixAnnee[]    findAll()
 * @method ChoixAnnee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoixAnneeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChoixAnnee::class);
    }

    // /**
    //  * @return ChoixAnnee[] Returns an array of ChoixAnnee objects
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
    public function findOneBySomeField($value): ?ChoixAnnee
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
