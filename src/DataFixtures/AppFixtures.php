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
use App\Entity\Classe;
use App\Entity\Cycle;
use App\Entity\NiveauScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cycle1 = new Cycle();
        $cycle1->setLibelle("Cycle 1");
        $manager->persist($cycle1);

        $cycle2 = new Cycle();
        $cycle2->setLibelle("Cycle 2");
        $manager->persist($cycle2);

        $cycle3 = new Cycle();
        $cycle3->setLibelle("Cycle 3");
        $manager->persist($cycle3);

        $cycle4 = new Cycle();
        $cycle4->setLibelle("Cycle 4");
        $manager->persist($cycle4);

        $classe1 = new Classe();
        $classe1->setLibelleClasse("CP");
        $classe1->setCycle($cycle1);
        $manager->persist($classe1);

        $classe2 = new Classe();
        $classe2->setLibelleClasse("CE1");
        $classe2->setCycle($cycle1);
        $manager->persist($classe2);

        $classe3 = new Classe();
        $classe3->setLibelleClasse("CE2");
        $classe3->setCycle($cycle1);
        $manager->persist($classe3);

        $classe4 = new Classe();
        $classe4->setLibelleClasse("CM1");
        $classe4->setCycle($cycle2);
        $manager->persist($classe4);

        $classe5 = new Classe();
        $classe5->setLibelleClasse("CM2");
        $classe5->setCycle($cycle2);
        $manager->persist($classe5);

        $classe6 = new Classe();
        $classe6->setLibelleClasse("6ème");
        $classe6->setCycle($cycle2);
        $manager->persist($classe6);

        $classe7 = new Classe();
        $classe7->setLibelleClasse("5ème");
        $classe7->setCycle($cycle3);
        $manager->persist($classe7);

        $classe8 = new Classe();
        $classe8->setLibelleClasse("4ème");
        $classe8->setCycle($cycle3);
        $manager->persist($classe8);

        $classe9 = new Classe();
        $classe9->setLibelleClasse("3ème");
        $classe9->setCycle($cycle3);
        $manager->persist($classe9);

        $classe10 = new Classe();
        $classe10->setLibelleClasse("2nd");
        $classe10->setCycle($cycle3);
        $manager->persist($classe10);

        $classe11 = new Classe();
        $classe11->setLibelleClasse("1ère");
        $classe11->setCycle($cycle4);
        $manager->persist($classe11);

        $classe12 = new Classe();
        $classe12->setLibelleClasse("Terminale");
        $classe12->setCycle($cycle4);
        $manager->persist($classe12);

        $classe13 = new Classe();
        $classe13->setLibelleClasse("CAP1");
        $classe13->setCycle($cycle4);
        $manager->persist($classe13);

        $classe14 = new Classe();
        $classe14->setLibelleClasse("CAP2");
        $classe14->setCycle($cycle4);
        $manager->persist($classe14);

        $classe15 = new Classe();
        $classe15->setLibelleClasse("BEP1");
        $classe15->setCycle($cycle4);
        $manager->persist($classe15);

        $classe16 = new Classe();
        $classe16->setLibelleClasse("BEP2");
        $classe16->setCycle($cycle4);
        $manager->persist($classe16);

        $niveauScolaire1 = new NiveauScolaire();
        $niveauScolaire1->setLibelle("CP");
        $niveauScolaire1->setCycle($cycle1);
        $manager->persist($niveauScolaire1);

        $niveauScolaire2 = new NiveauScolaire();
        $niveauScolaire2->setLibelle("CE1");
        $niveauScolaire2->setCycle($cycle2);
        $manager->persist($niveauScolaire2);

        $niveauScolaire3 = new NiveauScolaire();
        $niveauScolaire3->setLibelle("CE2");
        $niveauScolaire3->setCycle($cycle1);
        $manager->persist($niveauScolaire3);

        $niveauScolaire4 = new NiveauScolaire();
        $niveauScolaire4->setLibelle("CM1");
        $niveauScolaire4->setCycle($cycle2);
        $manager->persist($niveauScolaire4);

        $niveauScolaire5 = new NiveauScolaire();
        $niveauScolaire5->setLibelle("CM2");
        $niveauScolaire5->setCycle($cycle2);
        $manager->persist($niveauScolaire5);

        $niveauScolaire6 = new NiveauScolaire();
        $niveauScolaire6->setLibelle("6ème");
        $niveauScolaire6->setCycle($cycle2);
        $manager->persist($niveauScolaire6);

        $niveauScolaire7 = new NiveauScolaire();
        $niveauScolaire7->setLibelle("5ème");
        $niveauScolaire7->setCycle($cycle3);
        $manager->persist($niveauScolaire7);

        $niveauScolaire8 = new NiveauScolaire();
        $niveauScolaire8->setLibelle("4ème");
        $niveauScolaire8->setCycle($cycle3);
        $manager->persist($niveauScolaire8);

        $niveauScolaire9 = new NiveauScolaire();
        $niveauScolaire9->setLibelle("3ème");
        $niveauScolaire9->setCycle($cycle3);
        $manager->persist($niveauScolaire9);

        $niveauScolaire10 = new NiveauScolaire();
        $niveauScolaire10->setLibelle("2nd");
        $niveauScolaire10->setCycle($cycle3);
        $manager->persist($niveauScolaire10);

        $niveauScolaire11 = new NiveauScolaire();
        $niveauScolaire11->setLibelle("1ère");
        $niveauScolaire11->setCycle($cycle4);
        $manager->persist($niveauScolaire11);

        $niveauScolaire12 = new NiveauScolaire();
        $niveauScolaire12->setLibelle("Terminale");
        $niveauScolaire12->setCycle($cycle4);
        $manager->persist($niveauScolaire12);

        $niveauScolaire13 = new NiveauScolaire();
        $niveauScolaire13->setLibelle("CAP1");
        $niveauScolaire13->setCycle($cycle4);
        $manager->persist($niveauScolaire13);

        $niveauScolaire14 = new NiveauScolaire();
        $niveauScolaire14->setLibelle("CAP2");
        $niveauScolaire14->setCycle($cycle4);
        $manager->persist($niveauScolaire14);

        $niveauScolaire15 = new NiveauScolaire();
        $niveauScolaire15->setLibelle("BEP1");
        $niveauScolaire15->setCycle($cycle4);
        $manager->persist($niveauScolaire15);

        $niveauScolaire16 = new NiveauScolaire();
        $niveauScolaire16->setLibelle("BEP2");
        $niveauScolaire16->setCycle($cycle4);
        $manager->persist($niveauScolaire16);

        $annee1 = new Annee();
        $annee1->setAnnee("2020");
        $manager->persist($annee1);

        $ChampApprentissage1 = new ChampApprentissage();
        $ChampApprentissage1->setLibelle("Endurance");
        $ChampApprentissage1->setColor("#ef9a9a");
        $manager->persist($ChampApprentissage1);

        $ChampApprentissage2 = new ChampApprentissage();
        $ChampApprentissage2->setLibelle("Natation");
        $ChampApprentissage2->setColor("#aed581");
        $manager->persist($ChampApprentissage2);

        $ChampApprentissage3 = new ChampApprentissage();
        $ChampApprentissage3->setLibelle("Artistique");
        $ChampApprentissage3->setColor("#81d4fa");
        $manager->persist($ChampApprentissage3);

        $ChampApprentissage4 = new ChampApprentissage();
        $ChampApprentissage4->setLibelle("Affrontement");
        $ChampApprentissage4->setColor("#ffcc80");
        $manager->persist($ChampApprentissage4);

        $ChampApprentissage5 = new ChampApprentissage();
        $ChampApprentissage5->setLibelle("Renfort du corps");
        $ChampApprentissage5->setColor("#ce93d8");
        $manager->persist($ChampApprentissage5);

        $ChoixAnnee1 = new ChoixAnnee();
        $ChoixAnnee1->setAnnee($annee1);
        $ChoixAnnee1->setChampApprentissage($ChampApprentissage1);
        $ChoixAnnee1->setNiveau($niveauScolaire1);

        $manager->persist($ChoixAnnee1);

        $Apsa1 = new Apsa();
        $Apsa1->setLibelle("500M");
        $manager->persist($Apsa1);

        $Apsa2 = new Apsa();
        $Apsa2->setLibelle("Saut en hauteur");
        $manager->persist($Apsa2);

        $Apsa3 = new Apsa();
        $Apsa3->setLibelle("Saut de haie");
        $manager->persist($Apsa3);

        $Apsa4 = new Apsa();
        $Apsa4->setLibelle("Cours");
        $manager->persist($Apsa4);

        $Apsa5 = new Apsa();
        $Apsa5->setLibelle("Lancer de javelot");
        $manager->persist($Apsa5);

        $Apsa6 = new Apsa();
        $Apsa6->setLibelle("Lancer de disque");
        $manager->persist($Apsa6);

        $Apsa7 = new Apsa();
        $Apsa7->setLibelle("Lancer de poids");
        $manager->persist($Apsa7);

        $Apsa8 = new Apsa();
        $Apsa8->setLibelle("Lancer de marteau");
        $manager->persist($Apsa8);

        $Apsa9 = new Apsa();
        $Apsa9->setLibelle("Gymnastique saut de cheval");
        $manager->persist($Apsa9);

        $Apsa10 = new Apsa();
        $Apsa10->setLibelle("Gymnastique artistiique");
        $manager->persist($Apsa10);

        $Apsa11 = new Apsa();
        $Apsa11->setLibelle("Cirque");
        $manager->persist($Apsa11);

        $Apsa12 = new Apsa();
        $Apsa12->setLibelle("Judo");
        $manager->persist($Apsa12);

        $Apsa13 = new Apsa();
        $Apsa13->setLibelle("Karaté");
        $manager->persist($Apsa13);

        $Apsa14 = new Apsa();
        $Apsa14->setLibelle("Lutte");
        $manager->persist($Apsa14);

        $Apsa14 = new Apsa();
        $Apsa14->setLibelle("Musculation");
        $manager->persist($Apsa14);

        $Apsa15 = new Apsa();
        $Apsa15->setLibelle("Rugby");
        $manager->persist($Apsa15);

        $Apsa15 = new Apsa();
        $Apsa15->setLibelle("Football");
        $manager->persist($Apsa15);

        $Apsa16 = new Apsa();
        $Apsa16->setLibelle("Handball");
        $manager->persist($Apsa16);

        $Apsa17 = new Apsa();
        $Apsa17->setLibelle("Natation");
        $manager->persist($Apsa17);

        $Apsa18 = new Apsa();
        $Apsa18->setLibelle("Course d'orientation");
        $manager->persist($Apsa18);

        $champApprentissageApsa1 = new ChampsApprentissageApsa();
        $champApprentissageApsa1->setApsa($Apsa1);
        $champApprentissageApsa1->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa1);

        $champApprentissageApsa2 = new ChampsApprentissageApsa();
        $champApprentissageApsa2->setApsa($Apsa2);
        $champApprentissageApsa2->setChampApprentissage($ChampApprentissage2);
        $manager->persist($champApprentissageApsa2);

        $champApprentissageApsa3 = new ChampsApprentissageApsa();
        $champApprentissageApsa3->setApsa($Apsa12);
        $champApprentissageApsa3->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa3);

        $champApprentissageApsa4 = new ChampsApprentissageApsa();
        $champApprentissageApsa4->setApsa($Apsa5);
        $champApprentissageApsa4->setChampApprentissage($ChampApprentissage4);
        $manager->persist($champApprentissageApsa4);

        $champApprentissageApsa5 = new ChampsApprentissageApsa();
        $champApprentissageApsa5->setApsa($Apsa18);
        $champApprentissageApsa5->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa5);

        $champApprentissageApsa6 = new ChampsApprentissageApsa();
        $champApprentissageApsa6->setApsa($Apsa17);
        $champApprentissageApsa6->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa6);

        $champApprentissageApsa7 = new ChampsApprentissageApsa();
        $champApprentissageApsa7->setApsa($Apsa11);
        $champApprentissageApsa7->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa7);

        $champApprentissageApsa8 = new ChampsApprentissageApsa();
        $champApprentissageApsa8->setApsa($Apsa18);
        $champApprentissageApsa8->setChampApprentissage($ChampApprentissage2);
        $manager->persist($champApprentissageApsa8);

        $champApprentissageApsa9 = new ChampsApprentissageApsa();
        $champApprentissageApsa9->setApsa($Apsa10);
        $champApprentissageApsa9->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa9);

        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa13);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa6);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa11);

        $Af1 = new Af();
        $Af1->setLibelle("Produire des efforts");
        $Af1->setDescription("Produire et répartir intentionnellement ses efforts en mobilisant ses ressources pour gagner ou pour battre un record.");
        $manager->persist($Af1);

        $Af2 = new Af();
        $Af2->setLibelle("Connaître et utilser des techniques");
        $Af2->setDescription("Connaître et utiliser des techniques adaptées pour produire la meilleure performance possible.");
        $manager->persist($Af2);

        $Af3 = new Af();
        $Af3->setLibelle("S’engager et persévére");
        $Af3->setDescription("S’engager et persévérer, seul ou à plusieurs, dans des efforts répétés pour progresser dans une activité de performance.");
        $manager->persist($Af3);

        $Af4 = new Af();
        $Af4->setLibelle("S’impliquer dans des rôles sociaux");
        $Af4->setDescription("S’impliquer dans des rôles sociaux pour assurer le bon déroulement d’une épreuve de production de performance.");
        $manager->persist($Af4);

        $Af5 = new Af();
        $Af5->setLibelle("Se préparer à un effort long ou intense");
        $Af5->setDescription("Se préparer à un effort long ou intense pour être efficace dans la production d’une performance à une échéance donnée.");
        $manager->persist($Af5);

        $Af6 = new Af();
        $Af6->setLibelle("Identifier ses progrès");
        $Af6->setDescription("Identifier ses progrès et connaître sa meilleure performance réalisée pour la situer culturellement.");
        $manager->persist($Af6);

        $manager->flush();
    }
}
