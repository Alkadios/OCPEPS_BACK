<?php

namespace App\Repository;

use App\Entity\ApsaRetenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EvaluationEleveRepository;

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

    public function findApsaRetenuIfEleveHaveEval($idEleve)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
           SELECT apsa.id as 'id_apsa', apsa.libelle as 'libelle_apsa', a.id as 'id_annne', a.annee as 'libelle_annee', 
           e.id as 'id_etablissement', e.nom as 'nom_etablissement', cl.id as 'id_classe', cl.libelle_classe 
           FROM evaluation_eleve ee 
               INNER JOIN eleve el ON el.id = ee.eleve_id 
               INNER JOIN indicateur i ON i.id = ee.indicateur_id 
               INNER JOIN critere c ON c.id = i.critere_id 
               INNER JOIN apsa_retenu ar ON ar.id = c.apsa_retenu_id 
               INNER JOIN apsa_select_annee asa ON asa.id = ar.apsa_select_annee_id 
               INNER JOIN af_retenu afr ON afr.id = ar.af_retenu_id 
               INNER JOIN choix_annee ca ON ca.id = afr.choix_annee_id 
               INNER JOIN niveau_scolaire ns ON ns.id = ca.niveau_id 
               INNER JOIN classe cl ON cl.niveau_scolaire_id = ns.id 
               INNER JOIN annee a ON a.id = ca.annee_id 
               INNER JOIN etablissement e ON e.id = asa.etablissement_id 
               INNER JOIN apsa ON apsa.id = asa.apsa_id 
           WHERE ee.eleve_id = :idEleve 
           GROUP BY apsa.id, apsa.libelle, a.id, a.annee, e.id, e.nom, cl.id, cl.libelle_classe;";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['idEleve' => $idEleve]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

public
function subquery()
{
    return $this->createQueryBuilder('i')
        ->select('i.indicateur.id')
        ->from('AcmeDemoBundle:EvaluationEleve', 'ev')
        ->where('ev.eleve.id = :idEleve') // move setParameter() to main queryBuilder!
        ;
}


public
function findOneBySomeField($value): ?ApsaRetenu
{
    return $this->createQueryBuilder('a')
        ->andWhere('a.exampleField = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getOneOrNullResult();
}

}
