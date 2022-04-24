<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\User;
use App\Repository\EleveRepository;
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

            array_push($jsonres, ["id" => $user->getId(), "roles" => $user->getRoles()]);

            return new JsonResponse(array("message" => "Created", "utilisateur" => $jsonres), 201);

        } else {
            return new Response('Infos manquantes', 404);
        }
    }



    /**
     * @Route("api/eleve/create", name="eleve-create", methods={"POST"})
     */
    public function createEleve(Request $request,EtablissementRepository $etablissementRepository,  UserPasswordHasherInterface $passwordEncoder,EleveRepository $eleveRepository, EntityManagerInterface $manager): Response
    {

        $JsonContent = json_decode($request->getContent());



        $email = $JsonContent->email;
        $roles = $JsonContent->roles;
        $password = $JsonContent->password;
        $nom = $JsonContent->nom;
        $prenom = $JsonContent->prenom;
        $telephone = $JsonContent->telephone;
        $mailParent1 = $JsonContent->mailParent1;
        $mailParent2 = $JsonContent->mailParent2;
        $sexeEleve = $JsonContent->sexeEleve;
        $etablissement = $JsonContent->etablissement;

        if (
            isset($email) &&
            isset($roles) &&
            isset($password) &&
            isset($nom) &&
            isset($prenom) &&
            isset($telephone) &&
            isset($sexeEleve)
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

            $etablissementObject = $etablissementRepository->find($etablissement);

            $eleve = new Eleve();
            $eleve->setNom($nom);
            $eleve->setPrenom($prenom);
            $eleve->setTelephone($telephone);
            $eleve->setMailParent1($mailParent1);
            $eleve->setMailParent2($mailParent2);
            $eleve->setSexeEleve($sexeEleve);
            $eleve->setUser($user);
            $eleve->setEtablissement($etablissementObject);
            $manager->persist($eleve);
            $manager->flush();



            $jsonres = [];

            array_push($jsonres,["id" => $user->getId() , "roles" => $user->getRoles() , "eleveId" => $eleve->getId() , "nom" => $eleve->getNom() , "prenom" => $eleve->getPrenom()]);

            return new JsonResponse(array("message" => "Created", "eleve" => $jsonres), 201);

        } else {
            return new Response('Infos manquantes', 404);
        }
    }

}