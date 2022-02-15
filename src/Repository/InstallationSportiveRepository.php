<?php

namespace App\Repository;

use App\Entity\InstallationSportive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InstallationSportive|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstallationSportive|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstallationSportive[]    findAll()
 * @method InstallationSportive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstallationSportiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstallationSportive::class);
    }

    // /**
    //  * @return InstallationSportive[] Returns an array of InstallationSportive objects
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
    public function findOneBySomeField($value): ?InstallationSportive
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
