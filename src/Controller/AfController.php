<?php


namespace App\Controller;


use App\Entity\AfRetenu;
use App\Entity\ApsaSelectAnnee;
use App\Entity\ChoixAnnee;
use App\Repository\AfRepository;
use App\Repository\AfRetenuRepository;
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

class AfController extends AbstractController
{

    private function searchInAfRetenu($AfRetenus, $idAf ,$choixAnneeId)
    {
        $trouver = false;

        foreach ($AfRetenus as $AfRetenu) {
            if ($AfRetenu->getAf() == $idAf  && $AfRetenu->getChoixAnnee()->getId() == $choixAnneeId){
                $trouver = true;
                break;
            }
        }
        return $trouver;
    }



    /**
     * @Route("/api/choix_annees/{id}/deleteAndReplaceAF", name="deleteAndReplaceAF", methods={"POST"})
     */
    public function deleteAndReplaceAF(Request $request, AfRepository $afRepository ,AfRetenuRepository $afRetenuRepository, EntityManagerInterface $manager, ChoixAnnee $choixAnnee): Response
    {
        // Récuperation du contenu Json
        $JsonContent = json_decode($request->getContent());
        // Tableau contenant  la réponse lors de l'ajout
        $jsonres = [];

        // Tableau contenant les ApsaSelect à partir du JSON mais sous forme d'objet
        $AfRetenuByJson = [];

        $AfRetenus = $afRetenuRepository->findBy(["ChoixAnnee" => $choixAnnee ]);



        foreach ($JsonContent as $JsonEntry) {
            $afEntry = $JsonEntry->Af;

              $NewAfRetenu = new AfRetenu();

              $ObjectAf = $afRepository->find($afEntry);

              $NewAfRetenu->setAf($ObjectAf);
              $NewAfRetenu->setChoixAnnee($choixAnnee);
              array_push($AfRetenuByJson,$NewAfRetenu);


              if (!$this->searchInAfRetenu($AfRetenus, $afEntry ,$choixAnnee)) {

              $manager->persist($NewAfRetenu);
              $manager->flush();
              array_push($jsonres, ["id" => $NewAfRetenu->getId(), "caId" => $NewAfRetenu->getAf()->getId(), "apsaId" => $NewAfRetenu->getChoixAnnee()->getId()]);

              }

        }


        $AfRetenuAfterInsert = [];
        array_push($AfRetenuAfterInsert,$afRetenuRepository->findBy(["ChoixAnnee" => $choixAnnee]));

        //Si le nombre de données est différent entre le JSON et la BDD
        if (count($JsonContent) != count($AfRetenuAfterInsert[0])) {
            foreach ($AfRetenuAfterInsert[0] as $afBDD) {
                if (!$this->searchInAfRetenu($AfRetenuByJson, $afBDD->getAf()->getId(), $afBDD->getChoixAnnee()->getId())) {
                    $manager->remove($afBDD);
                    $manager->flush();
                }
            }


        }
        return new JsonResponse(array("AfRetenu" => $jsonres), 201);
    }
}