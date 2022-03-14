<?php


namespace App\Controller;

use App\Entity\Apsa;
use App\Entity\Ca;
use App\Entity\ChampApprentissage;
use App\Entity\ChampsApprentissageApsa;
use App\Entity\Utilisateur;
use App\Repository\ApsaRepository;
use App\Repository\ChampApprentissageRepository;
use App\Repository\ChampsApprentissageApsaRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class CAController extends AbstractController
{


    /**
     * @Route("api/Apsa/{id}", name="retirerApsa", methods={"GET"})
     */
    public function Apsa( ChampsApprentissageApsaRepository $champsApprentissageApsaRepository ,ApsaRepository $apsarep, ChampApprentissage $ca,ChampApprentissageRepository $champrep): Response
    {

        $caCorrespondant = $champrep->findChamp($ca);
        $champsApsa = array(...);

        $test = $champsApprentissageApsaRepository->deletechampsApsa($champsApsa);

            foreach ($ca as $key => $caa) {

                if($ca == $caCorrespondant ) {
                array_push($jsonres, [ "Suppression" => $caa->removeChampsApprentissageApsa($apsa)]);
                }
                else {
                    array_push($jsonres, [ "Inserer" => $caa->addChampsApprentissageApsa($apsa)]);
                }
          }

        return new JsonResponse(array("ApsaSelectionner" => $jsonres), 200);

    }




}