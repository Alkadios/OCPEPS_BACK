<?php

namespace App\DataFixtures;

use App\Entity\Af;
use App\Entity\AfRetenu;
use App\Entity\Annee;
use App\Entity\Apsa;
use App\Entity\ApsaRetenu;
use App\Entity\ChampApprentissage;
use App\Entity\ChampsApprentissageApsa;
use App\Entity\ChoixAnnee;
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



        $ChampApprentissage1 = new ChampApprentissage();
        $ChampApprentissage1->setLibelle("Artistique");
        $ChampApprentissage1->setColor("bleue");
        $manager->persist($ChampApprentissage1);

        $ChoixAnnee1 = new ChoixAnnee();
        $ChoixAnnee1->setAnnee($annee1);
        $ChoixAnnee1->setChampApprentissage($ChampApprentissage1);
        $ChoixAnnee1->setNiveau($NiveauScolaire1);

        $manager->persist($ChoixAnnee1);



        $Apsa1 = new Apsa();
        $Apsa1->setLibelle("Foot");
        $manager->persist($Apsa1);


        $Apsa2 = new Apsa();
        $Apsa2->setLibelle("Basketball");
        $manager->persist($Apsa2);

        $Apsa3 = new Apsa();
        $Apsa3->setLibelle("Rugby");
        $manager->persist($Apsa3);

        $Apsa4 = new Apsa();
        $Apsa4->setLibelle("Quiditch");
        $manager->persist($Apsa4);


        $Apsa5 = new Apsa();
        $Apsa5->setLibelle("Volley");
        $manager->persist($Apsa5);

        $Apsa6 = new Apsa();
        $Apsa6->setLibelle("Sprint");
        $manager->persist($Apsa6);


        $ChampsApprentissageApsa1 = new ChampsApprentissageApsa();
        $ChampsApprentissageApsa1->setApsa($Apsa1);
        $ChampsApprentissageApsa1->setChampApprentissage($ChampApprentissage1);
        $manager->persist($ChampsApprentissageApsa1);

        $Af1 = new Af();
        $Af1->setLibelle("Produire des efforts");
        $Af1->setDescription("Produire des efforts au dela de 50 km");
        $manager->persist($Af1);

        $Af2 = new Af();
        $Af2->setLibelle("Courrir vite");
        $Af2->setDescription("Courrir très vite");
        $manager->persist($Af2);

        $Af3 = new Af();
        $Af3->setLibelle("Tirer vite");
        $Af3->setDescription("tirer très vite");
        $manager->persist($Af3);

        $Af4 = new Af();
        $Af4->setLibelle("Respecter ses adversaires");
        $Af4->setDescription("savoir jouer contre un adversaire");
        $manager->persist($Af4);


        $Af5 = new Af();
        $Af5->setLibelle("Cohesion d'equipe");
        $Af5->setDescription("Avoir une bonne cohesion d'equipe");
        $manager->persist($Af5);


        $Af6 = new Af();
        $Af6->setLibelle("S'ameliorer");
        $Af6->setDescription("savoir apprendre de ses erreurs et s'ameliorer");
        $manager->persist($Af6);


        $Af7 = new Af();
        $Af7->setLibelle("Partager la balle");
        $Af7->setDescription("Envoyer vite la balle a un coequipier");
        $manager->persist($Af7);




        $AfRetenu1 = new AfRetenu();
        $AfRetenu1->setAf($Af1);
        $AfRetenu1->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu1);

        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af2);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);

        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af3);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);

        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af4);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);


        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af5);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);



        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af6);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);



        $AfRetenu2 = new AfRetenu();
        $AfRetenu2->setAf($Af7);
        $AfRetenu2->setChoixAnnee($ChoixAnnee1);
        $manager->persist($AfRetenu2);



        $ApsaRetenu1 = new ApsaRetenu();
        $ApsaRetenu1->setAfRetenu($AfRetenu2);
        $ApsaRetenu1->setApsa($Apsa3);
        $ApsaRetenu1->setSituationEvaluation("t'es nul mec");
        $manager->persist($ApsaRetenu1);

        $ApsaRetenu2 = new ApsaRetenu();
        $ApsaRetenu2->setAfRetenu($AfRetenu2);
        $ApsaRetenu2->setApsa($Apsa4);
        $ApsaRetenu2->setSituationEvaluation("trop for");
        $manager->persist($ApsaRetenu2);

        $ApsaRetenu3 = new ApsaRetenu();
        $ApsaRetenu3->setAfRetenu($AfRetenu2);
        $ApsaRetenu3->setApsa($Apsa5);
        $ApsaRetenu3->setSituationEvaluation("megachaud");
        $manager->persist($ApsaRetenu3);

        $ApsaRetenu4 = new ApsaRetenu();
        $ApsaRetenu4->setAfRetenu($AfRetenu2);
        $ApsaRetenu4->setApsa($Apsa6);
        $ApsaRetenu4->setSituationEvaluation("GIGACHAD");
        $manager->persist($ApsaRetenu4);




        $manager->flush();
    }
}
