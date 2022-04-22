<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class UtilisateurController extends AbstractController
{


    /**
     * @Route("api/utilisateur", name="utilisateur-create", methods={"POST"})
     */
    public function createUser(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $manager): Response
    {

        $JsonContent = json_decode($request->getContent());


        
        $email = $JsonContent->email;
        $roles = $JsonContent->roles;
        $password = $JsonContent->password;

        if (
            isset($email) &&
            isset($roles) &&
            isset($password)
        ) {

            $user = new User();


            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $password
                )
            );
            $manager->persist($user);
            $manager->flush();

            $jsonres = [];

            array_push($jsonres,["id" => $user->getId() , "roles" => $user->getRoles()]);

            return new JsonResponse(array("message" => "Created", "utilisateur" => $jsonres), 201);

        } else {
            return new Response('Infos manquantes', 404);
        }
    }

}