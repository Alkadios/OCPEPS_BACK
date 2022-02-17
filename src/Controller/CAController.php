<?php


namespace App\Controller;

use App\Entity\Apsa;
use App\Entity\Ca;
use App\Entity\Utilisateur;
use App\Repository\ApsaRepository;
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
     * @Route("api/AddApsaToCa/{id}/apsa/{ida}", name="AddApsaToCa", methods={"POST"})
     * @ParamConverter("apsa", options={"id" = "ida"})
     */
    public function AddApsaToCa(Request $request, Ca $ca , Apsa $apsa, ApsaRepository $apsaRepository, EntityManagerInterface $manager ): Response
    {

                $ca->addApsa($apsa);
                $manager->persist($ca);
                $manager->flush();

        $jsonres = [];


            array_push($jsonres, ["addApsa" => $ca->addApsa($apsa)]);

        return new JsonResponse(array("message" => "Apsa Ajouter", "Apsa" => $jsonres), 201);


    }






}