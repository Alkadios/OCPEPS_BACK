<?php

namespace App\Controller;

use App\Repository\ApsaRetenuRepository;
use App\Repository\EvaluationEleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;
class EleveController extends AbstractController
{

    /**
     * @Route("api/eleves/{id}/apsaRetenu", name="apsaRetenuByEleve", methods={"GET"})
     */
    public function apsaRetenuByEleve(int $id, ApsaRetenuRepository $apsaRetenuRepository, EvaluationEleveRepository $evaluationEleveRepository): Response
    {
        return $this->json($apsaRetenuRepository->findApsaRetenuIfEleveHaveEval($id));
    }
}
