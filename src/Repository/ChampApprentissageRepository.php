<?php

namespace App\Repository;

use App\Entity\ChampApprentissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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

    public function findChampsApp($value)
    {
        return $this->createQueryBuilder('c')
            ->Where('c.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function findApsa()
    {

        $query = $this->getEntityManager()->createQuery("
        SELECT apsa.libelle 
        FROM App\Entity\ChampApprentissage as champ_apprentissage
        JOIN App\Entity\ChampsApprentissageApsa as champsapprentissageapsa WITH champ_apprentissage.id = champsapprentissageapsa.ChampApprentissage 
        JOIN App\Entity\Apsa as apsa WITH champsapprentissageapsa.Apsa = apsa.id
        ");
//        return $this->createQueryBuilder('apsa')
//            ->select('*')
//            ->from('ChampApprentissage', 'ca')
//            ->innerJoin('ChampsApprentissageApsa', 'caapsa', 'ON', 'ca.id = caapsa.champ_apprentissage_id')
//            ->innerJoin('Apsa', 'apsa', 'ON', 'caapsa.apsa_id = apsa.id')
//            ->getQuery();
        $query->execute();

        return $query->getArrayResult();
    }


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
