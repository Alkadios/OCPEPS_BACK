<?php

namespace App\Controller;

use App\Repository\ChampApprentissageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApsaChampApprentissageController extends AbstractController
{
    public function __invoke(ChampApprentissageRepository $champApprentissageRepository): string
    {
        return json_encode($champApprentissageRepository->findApsa());
    }
}
