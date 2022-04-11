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

class ApsaSelectAnneeController extends AbstractController
{

    private function searchInApsaSelectAnnee($ApsaSelectAnnees, $idCa, $idApsa, $idAnnee){
        $trouver=false;

        foreach ($ApsaSelectAnnees as $apsaSelectAnnee){
            if($apsaSelectAnnee->getApsa()->getId() == $idApsa && $apsaSelectAnnee->getCa()->getId() == $idCa
                && $apsaSelectAnnee->getAnnee()->getId() == $idAnnee){
                $trouver = true;
                break;
            }
        }
        return $trouver;

    }

    /**
     * @Route("api/apsa_select_annees/deleteAndReplace", name="deleteApsaSelectAnneeAndReplace", methods={"POST"})
     */
    public function Apsa(ApsaSelectAnneeRepository $apsaSelectAnneeRepository, AnneeRepository $anneeRepository, ChampApprentissageRepository $champApprentissageRepository, ApsaRepository $apsaRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $jsonres = [];

        $apsaSelectAnneeAlreadySaved = [];

        $donnees = json_decode($request->getContent());
        $ApsaSelectAnnees = [];
        if(count($donnees) > 0) {
            $ApsaSelectAnnees = $apsaSelectAnneeRepository->findBy(["Annee" => $donnees[0]->Annee]);
        }

        foreach ($donnees as $donnee) {
            $ca_id = $donnee->Ca;
            $apsa_id = $donnee->Apsa;
            $annee_id = $donnee->Annee;

            $NewChampsApsaSelectAnnee = new ApsaSelectAnnee();

            if (
            isset($apsa_id)
            ) {
                $apsa = $apsaRepository->find($apsa_id);
                $ca = $champApprentissageRepository->find($ca_id);
                $annee = $anneeRepository->find($annee_id);
                if($this->searchInApsaSelectAnnee($ApsaSelectAnnees,$ca_id,$apsa_id,$annee_id)){

                    if(count($ApsaSelectAnnees) != count($apsaSelectAnneeAlreadySaved)){
                        foreach ($ApsaSelectAnnees as $apsaBDD){
                            if(!$this->searchInApsaSelectAnnee($apsaSelectAnneeAlreadySaved,$apsaBDD->getCa()->getId(),
                                $apsaBDD->getApsa()->getId(),$apsaBDD->getAnnee()->getId())){
                                $manager->remove($apsaBDD);
                                $manager->flush();
                            }
                        }
                    }

                }else{
                    $NewChampsApsaSelectAnnee->setApsa($apsa);
                    $NewChampsApsaSelectAnnee->setCa($ca);
                    $NewChampsApsaSelectAnnee->setAnnee($annee);
                    $manager->persist($NewChampsApsaSelectAnnee);
                    $manager->flush();
                    array_push($jsonres, ["id" => $NewChampsApsaSelectAnnee->getId(),
                        "caId" => $NewChampsApsaSelectAnnee->getCa()->getId(),
                        "apsaId" => $NewChampsApsaSelectAnnee->getApsa()->getId()]);
                }
            }
        }


        return new JsonResponse(array("ApsaSelectAnnee" => $jsonres), 200);
    }

}