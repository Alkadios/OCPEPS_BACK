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
     * @Route("api/deleteApsa/{id}", name="deleteApsa", methods={"DELETE"})
     */
    public function Apsa(ChampsApprentissageApsaRepository $champsApprentissageApsaRepository, ChampApprentissage $ca): Response
    {
        $res = $champsApprentissageApsaRepository->deleteApsa($ca);

        $jsonres=  [];
                array_push($jsonres, [ ]);

        return new JsonResponse(array("ApsaSelectionner" => $jsonres, "res" => $res), 200);

    }




}