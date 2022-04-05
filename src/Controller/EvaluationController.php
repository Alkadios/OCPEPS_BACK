<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationController extends AbstractController
{

    /**
     * @Route("api/CreateEvaluations", name="CreateEvaluations", methods={"POST"})
     */
    public function CreateEvaluations(EntityManagerInterface $manager ,EleveRepository $eleveRepository, Request $request ): Response
    {

        $jsonres = [];

        $donnees = json_decode($request->getContent());
        foreach ($donnees as $donnee) {
            $eleve_id = $donnee->Eleve;
            $label_eval= $donnee->label_eval;

            $NewEvaluations = new Evaluation();

            if (
                isset($eleve_id)
            ) {
                $eleve_id2 = $eleveRepository->find($eleve_id);
                $NewEvaluations->setELeve($eleve_id2);
                $NewEvaluations->setLabelEval($label_eval);
                $manager->persist($NewEvaluations);
                $manager->flush();
                array_push($jsonres, ["id" => $NewEvaluations->getId(), "EleveId" => $NewEvaluations->getELeve()->getId(), "DateEval" => $NewEvaluations->getDateEval()]);


            }
        }
        return new JsonResponse(array("Evaluations" => $jsonres), 200);

    }


}