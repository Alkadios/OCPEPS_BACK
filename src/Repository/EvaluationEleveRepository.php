<?php

namespace App\Repository;

use App\Entity\EvaluationEleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EvaluationEleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvaluationEleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvaluationEleve[]    findAll()
 * @method EvaluationEleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationEleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvaluationEleve::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EvaluationEleve $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(EvaluationEleve $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return EvaluationEleve[] Returns an array of EvaluationEleve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EvaluationEleve
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
public function getSousRequeteApsaRetenu($idEleve){
    return $this->createQueryBuilder('i')
        ->where('i.Eleve = :idEleve') // move setParameter() to main queryBuilder!
        ->setParameter('idEleve', $idEleve);
}

}
