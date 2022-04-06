<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\EvaluationIndicateur;
use App\Repository\ApsaRetenuRepository;
use App\Repository\EleveRepository;
use App\Repository\EvaluationRepository;
use App\Repository\IndicateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationController extends AbstractController
{

    /**
     * @Route("api/evaluation_indicateurs/plusieurs", name="evaluation_indicateurs", methods={"POST"})
     */
    public function CreateEvaluationsIndicateurs(EntityManagerInterface $manager ,EvaluationRepository $evaluationRepository,IndicateurRepository $indicateurRepository,EleveRepository $eleveRepository, Request $request ): Response
    {

        $jsonresEvalIndicateur = [];
        $donnees = json_decode($request->getContent());

        foreach ($donnees as $donnee) {


            $eleve_id = $donnee->Eleve;
            $indicateur_id = $donnee->Indicateur;
            $note = $donnee->note;


            $NewEvaluationsIndicateur = new EvaluationIndicateur();

            if (
                isset($eleve_id)
            ) {

                
                $indicateur_id2 = $indicateurRepository->find($indicateur_id);
                $eleve_id2 = $eleveRepository->find($eleve_id);
                $NewEvaluationsIndicateur->setIndicateur($indicateur_id2);
                $NewEvaluationsIndicateur->setEleve($eleve_id2);
                $NewEvaluationsIndicateur->setNote($note);
                $manager->persist($NewEvaluationsIndicateur);
                $manager->flush();
                array_push($jsonresEvalIndicateur, ["id" => $NewEvaluationsIndicateur->getId(), "EleveId" => $NewEvaluationsIndicateur->getEleve()->getId() ,"Indicateur" => $NewEvaluationsIndicateur->getIndicateur()->getId(), "note" => $NewEvaluationsIndicateur->getNote()]);



            }
        }
        return new JsonResponse(array("Evaluations" => $jsonresEvalIndicateur), 200);

    }


}