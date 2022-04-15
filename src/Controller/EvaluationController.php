<?php


namespace App\Controller;

use App\Entity\EvaluationEleve;
use App\Repository\IndicateurRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Evaluation;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EvaluationController extends AbstractController
{


    /**
     * @Route("api/CreateEvaluations", name="CreateEvaluations", methods={"POST"})
     */
    public function CreateEvaluations(EntityManagerInterface $manager , EleveRepository $eleveRepository ,IndicateurRepository $indicateurRepository, Request $request ): Response
    {
        $jsonres = [];

        $JsonContent = json_decode($request->getContent());
        foreach ($JsonContent as $JsonEntry) {

            $Indicateur = $JsonEntry->Indicateur;
            $Eleve = $JsonEntry->Eleve;
            $AutoEval = $JsonEntry->autoEval;
            $date = $JsonEntry->Date;

            $NewEvaluations = new Evaluation();

            $NewEvaluations->setDateEval(new DateTime($date));
            $manager->persist($NewEvaluations);
            $manager->flush();

            $NewEvaluationsEleve = new EvaluationEleve();

            $ObjetIndicateur = $indicateurRepository->find($Indicateur);
            $ObjetEleve = $eleveRepository->find($Eleve);

            $NewEvaluationsEleve->setEvaluation($NewEvaluations);
            $NewEvaluationsEleve->setEleve($ObjetEleve);
            $NewEvaluationsEleve->setIndicateur($ObjetIndicateur);
            $NewEvaluationsEleve->setAutoEval($AutoEval);



            array_push($jsonres, ["id" => $NewEvaluations->getId(), "DateEval" => $NewEvaluations->getDateEval() , "idNewEval" => $NewEvaluationsEleve->getId(), "IdElev" => $NewEvaluationsEleve->getEleve()->getId() , "IdIndic" => $NewEvaluationsEleve->getIndicateur()->getId(), "IdEval" => $NewEvaluationsEleve->getEvaluation()->getId() ]);
        }
        return new JsonResponse(array("Evaluations" => $jsonres), 201);
    }
}