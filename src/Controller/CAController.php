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
use Doctrine\Common\Collections\ArrayCollection;
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
     * @Route("api/deleteApsa/{id}", name="deleteApsa", methods={"POST"})
     */
    public function Apsa(ChampsApprentissageApsaRepository $champsApprentissageApsaRepository, ApsaRepository $apsaRepository ,Request $request ,ChampApprentissage $ca ,  EntityManagerInterface $manager): Response
    {


        $champsapsa = $champsApprentissageApsaRepository->findBy(["ChampApprentissage" => $ca]);
        $ListChampsApsa= $champsApprentissageApsaRepository->findAll();

        $jsonres=  [];


        foreach ($champsapsa as $champs)
        {
            if ($ca) {
                $manager->remove($champs);
                $manager->flush($ca);
            }
        }


            $donnees = json_decode($request->getContent());
            $apsa_id = $donnees->Apsa;

            if (
                isset($apsa_id)
            ) {
                $apsa_id2 = $apsaRepository->find($apsa_id);
                $ChampsApsa = new ChampsApprentissageApsa();
                $ChampsApsa->setApsa($apsa_id2);
                $ChampsApsa->setChampApprentissage($ca);
                $manager->persist($ChampsApsa);
                $manager->flush();


         }



        return new JsonResponse(array("Suppression" => $jsonres), 200);

    }




}