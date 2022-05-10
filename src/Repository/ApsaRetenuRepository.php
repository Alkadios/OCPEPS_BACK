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
            ->getResult();
    }

    public function findApsaRetenuIfEleveHaveEval($eleve)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.critere', 'c')
            ->innerJoin('c.indicateur', 'i')
            ->innerJoin('a.ApsaSelectAnnee', 'as')
            ->innerJoin('as.apsa', 'ap')
            ->innerJoin('as.annee', 'an')
            ->Where('i.id = IN', $this->subquery())
            ->setParameter('val', $eleve)
            ->getQuery()
            ->getResult();
    }


    public function subquery()
    {
        return $this->createQueryBuilder('i')
            ->select('i.indicateur.id')
            ->from('AcmeDemoBundle:EvaluationEleve', 'ev')
            ->where('ev.eleve.id = :val') // move setParameter() to main queryBuilder!
        ;

    }


    public function findOneBySomeField($value): ?ApsaRetenu
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
