<?php

namespace App\DataFixtures;

use App\Entity\Af;
use App\Entity\AfRetenu;
use App\Entity\Annee;
use App\Entity\Apsa;
use App\Entity\ApsaRetenu;
use App\Entity\ChampApprentissage;
use App\Entity\ChoixAnnee;
use App\Entity\Color;
use App\Entity\Cycle;
use App\Entity\NiveauScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cycle1 = new Cycle();
        $cycle1->setLibelle("Cycle1");
        $manager->persist($cycle1);

        $cycle2 = new Cycle();
        $cycle2->setLibelle("Cycle2");
        $manager->persist($cycle2);


        $NiveauScolaire1 = new NiveauScolaire();
        $NiveauScolaire1->setLibelle("CP");
        $NiveauScolaire1->setCycle($cycle1);
        $manager->persist($NiveauScolaire1);

        $NiveauScolaire2 = new NiveauScolaire();
        $NiveauScolaire2->setLibelle("CE1");
        $NiveauScolaire2->setCycle($cycle1);
        $manager->persist($NiveauScolaire2);

        $annee1 = new Annee();
        $annee1->setAnne(new \DateTime('now'));;
        $manager->persist($annee1);

        $color1 = new Color();
        $color1->setLibelle("Bleue");

        $ChampApprentissage1 = new ChampApprentissage();
        $ChampApprentissage1->setLibelle("Artistique");
        $ChampApprentissage1->setColor($color1);
        $manager->persist($ChampApprentissage1);

        $ChoixAnnee1 = new ChoixAnnee();
        $ChoixAnnee1->setAnnee($annee1);
        $ChoixAnnee1->setChampApprentissage($ChampApprentissage1);
        $ChoixAnnee1->setNiveau($NiveauScolaire1);

        $manager->persist($ChoixAnnee1);

        $Apsa1 = new Apsa();
        $Apsa1->setChampApprentissage($ChampApprentissage1);
        $Apsa1->setLibelle("Foot");
        $manager->persist($Apsa1);

        $Apsa2 = new Apsa();
        $Apsa2->setChampApprentissage($ChampApprentissage1);
        $Apsa2->setLibelle("Basketball");
        $manager->persist($Apsa2);


        $Af1 = new Af();
        $Af1->setLibelle("Produire des efforts");
        $Af1->setDescription("Produire des efforts au dela de 50 km");
        $manager->persist($Af1);

        $Af1 = new Af();
        $Af1->setLibelle("Courrir vite");
        $Af1->setDescription("Courrir très vite");
        $manager->persist($Af1);

        $Af2 = new Af();
        $Af2->setLibelle("Faire ses echauffemment");
        $Af2->setDescription("Faire des echauffements pour ne pas se blesser");
        $manager->persist($Af2);

        $AfRetenu1 = new AfRetenu();
        $AfRetenu1->setAf($Af1);
        $AfRetenu1->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu1);

        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af2);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);

        $ApsaRetenu1 = new ApsaRetenu();
        $ApsaRetenu1->setAfRetenu($AfRetenu2);
        $ApsaRetenu1->setApsa($Apsa2);
        $manager->persist($ApsaRetenu1);




        $manager->flush();
    }
}
