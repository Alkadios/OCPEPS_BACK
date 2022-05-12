<?php


namespace App\Controller;


use App\Entity\ApsaSelectAnnee;
use App\Repository\AnneeRepository;
use App\Repository\ApsaRepository;
use App\Repository\ApsaSelectAnneeRepository;
use App\Repository\ChampApprentissageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;

class ApsaRetenuController extends AbstractController
{

    /**
     * @Route("/apsa_retenus/{id}", name="project_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $project = $this->getDoctrine()
            ->getRepository(Project::class)
            ->find($id);

        if (!$project) {

            return $this->json('No project found for id' . $id, 404);
        }

        $data =  [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }
    /**
     * @Route("api/apsa_retenus/deleteAndReplace", name="deleteApsaSelectAnneeAndReplace", methods={"POST"})
     */
    public function deleteApsaSelectAnneeAndReplace(ApsaSelectAnneeRepository $apsaSelectAnneeRepository, AnneeRepository $anneeRepository, ChampApprentissageRepository $champApprentissageRepository, ApsaRepository $apsaRepository, Request $request, EntityManagerInterface $manager): Response
    {
        // Tableau contenant  la réponse lors de l'ajout
        $jsonres = [];
        // Récuperation du contenu Json
        $donnees = json_decode($request->getContent());

        // Tableau contenant les ApsaSelect à partir du JSON mais sous forme d'objet
        $apsaSelectAnneeObjectByJson = [];
        //Liste contenant tous les ApsaSelectAnne pour l'annee en cours (Grace à l'année du premier élément envoyer)
        $ApsaSelectAnnees = [];
        if (count($donnees) > 0) {
            $ApsaSelectAnnees = $apsaSelectAnneeRepository->findBy(["Annee" => $donnees[0]->Annee]);
        }

        foreach ($donnees as $donnee) {
            $ca_id = $donnee->Ca;
            $apsa_id = $donnee->Apsa;
            $annee_id = $donnee->Annee;

            if (isset($apsa_id) && isset($ca_id) && isset($annee_id)) {
                $apsa = $apsaRepository->find($apsa_id);
                $ca = $champApprentissageRepository->find($ca_id);
                $annee = $anneeRepository->find($annee_id);

                //Création de l'ApsaSelectAnnee
                $NewChampsApsaSelectAnnee = new ApsaSelectAnnee();
                $NewChampsApsaSelectAnnee->setApsa($apsa);
                $NewChampsApsaSelectAnnee->setCa($ca);
                $NewChampsApsaSelectAnnee->setAnnee($annee);

                array_push($apsaSelectAnneeObjectByJson,
                    $NewChampsApsaSelectAnnee);


                //Ajout dans la liste si l'apsaSelectAnnee existe déjà dans la BDD
                //array_push($apsaSelectAnneeAlreadySaved,
                //$apsaSelectAnneeRepository->findOneBy(["Ca" => $ca , "Apsa" => $apsa ,
                //   "Annee" => $annee]));
                //Vérifie si ApsaSelectAnnee envoyer (JSON) n'est pas dans la BDD
                if (!$this->searchInApsaSelectAnnee($ApsaSelectAnnees, $ca_id, $apsa_id, $annee_id)) {

                    $manager->persist($NewChampsApsaSelectAnnee);
                    $manager->flush();
                    array_push($jsonres, ["id" => $NewChampsApsaSelectAnnee->getId(),
                        "caId" => $NewChampsApsaSelectAnnee->getCa()->getId(),
                        "apsaId" => $NewChampsApsaSelectAnnee->getApsa()->getId()]);
                }
            }
        }

        /**
         * else{
         * if(count($ApsaSelectAnnees) != count($apsaSelectAnneeAlreadySaved)){
         * foreach ($ApsaSelectAnnees as $apsaBDD){
         * if(!$this->searchInApsaSelectAnnee($apsaSelectAnneeAlreadySaved,$apsaBDD->getCa()->getId(),$apsaBDD->getApsa()->getId(),$apsaBDD->getAnnee()->getId())){
         * $manager->remove($apsaBDD);
         * $manager->flush();
         * }
         * }
         * }
         *
         * } * */
        $ApsaSelectAnneesAfterInsert = [];
        array_push($ApsaSelectAnneesAfterInsert,
            $apsaSelectAnneeRepository->findBy([
                "Annee" => $donnees[0]->Annee]));

        //Si le nombre de données est différent entre le JSON et la BDD
        if (count($donnees) != count($ApsaSelectAnneesAfterInsert[0])) {
            foreach ($ApsaSelectAnneesAfterInsert[0] as $apsaBDD) {
                if (!$this->searchInApsaSelectAnnee($apsaSelectAnneeObjectByJson, $apsaBDD->getCa()->getId(), $apsaBDD->getApsa()->getId(), $apsaBDD->getAnnee()->getId())) {
                    $manager->remove($apsaBDD);
                    $manager->flush();
                }
            }


        }
        return new JsonResponse(array("ApsaSelectAnnee" => $jsonres), 200);
    }
}