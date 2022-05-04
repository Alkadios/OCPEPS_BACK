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
use App\Entity\Etablissement;
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
        $annee1->setAnnee("2021-2022");
        $annee1->setEnCours(true);
        $manager->persist($annee1);


        $annee1 = new Annee();
        $annee1->setAnnee("2020-2021");
        $annee1->setEnCours(false);
        $manager->persist($annee1);

        $annee1 = new Annee();
        $annee1->setAnnee("2019-2020");
        $annee1->setEnCours(false);
        $manager->persist($annee1);

        $etablissement = new Etablissement();
        $etablissement->setMail("saintjoseph@hotmail.fr");
        $etablissement->setAdresse("rue Saint Joseph");
        $etablissement->setCp(69120);
        $etablissement->setNom("Saint Joseph");
        $etablissement->setTel("0654956454");
        $etablissement->setVille("Lyon");

        $classe1 = new Classe();
        $classe1->setLibelleClasse("CP");
        $classe1->setNiveauScolaire($niveauScolaire2);
        $classe1->setAnnee($annee1);
        $classe1->setEtablissement($etablissement);
        $manager->persist($classe1);

        $classe2 = new Classe();
        $classe2->setLibelleClasse("CE1");
        $classe2->setNiveauScolaire($niveauScolaire3);
        $classe2->setAnnee($annee1);
        $classe2->setEtablissement($etablissement);
        $manager->persist($classe2);

        $classe3 = new Classe();
        $classe3->setLibelleClasse("CE2");
        $classe3->setNiveauScolaire($niveauScolaire1);
        $classe3->setAnnee($annee1);
        $classe3->setEtablissement($etablissement);
        $manager->persist($classe3);

        $classe4 = new Classe();
        $classe4->setLibelleClasse("CM1");
        $classe4->setNiveauScolaire($niveauScolaire4);
        $classe4->setAnnee($annee1);
        $classe4->setEtablissement($etablissement);
        $manager->persist($classe4);

        $classe5 = new Classe();
        $classe5->setLibelleClasse("CM2");
        $classe5->setNiveauScolaire($niveauScolaire5);
        $classe5->setAnnee($annee1);
        $classe5->setEtablissement($etablissement);
        $manager->persist($classe5);

        $classe6 = new Classe();
        $classe6->setLibelleClasse("6ème");
        $classe6->setNiveauScolaire($niveauScolaire6);
        $classe6->setAnnee($annee1);
        $classe6->setEtablissement($etablissement);
        $manager->persist($classe6);

        $classe7 = new Classe();
        $classe7->setLibelleClasse("5ème");
        $classe7->setNiveauScolaire($niveauScolaire7);
        $classe7->setAnnee($annee1);
        $classe7->setEtablissement($etablissement);
        $manager->persist($classe7);

        $classe8 = new Classe();
        $classe8->setLibelleClasse("4ème");
        $classe8->setNiveauScolaire($niveauScolaire8);
        $classe8->setAnnee($annee1);
        $classe8->setEtablissement($etablissement);
        $manager->persist($classe8);

        $classe9 = new Classe();
        $classe9->setLibelleClasse("3ème");
        $classe9->setNiveauScolaire($niveauScolaire9);
        $classe9->setAnnee($annee1);
        $classe9->setEtablissement($etablissement);
        $manager->persist($classe9);

        $classe10 = new Classe();
        $classe10->setLibelleClasse("2nd");
        $classe10->setNiveauScolaire($niveauScolaire10);
        $classe10->setAnnee($annee1);
        $classe10->setEtablissement($etablissement);
        $manager->persist($classe10);

        $classe11 = new Classe();
        $classe11->setLibelleClasse("1ère");
        $classe11->setNiveauScolaire($niveauScolaire11);
        $classe11->setAnnee($annee1);
        $classe11->setEtablissement($etablissement);
        $manager->persist($classe11);

        $classe12 = new Classe();
        $classe12->setLibelleClasse("Terminale");
        $classe12->setNiveauScolaire($niveauScolaire12);
        $classe12->setAnnee($annee1);
        $classe12->setEtablissement($etablissement);
        $manager->persist($classe12);


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
        $ChoixAnnee1->setEtablissement($etablissement);

        $manager->persist($ChoixAnnee1);

        $Apsa1 = new Apsa();
        $Apsa1->setLibelle("Course de fond");
        $manager->persist($Apsa1);

        $Apsa2 = new Apsa();
        $Apsa2->setLibelle("Lancer de disque");
        $manager->persist($Apsa2);

        $Apsa3 = new Apsa();
        $Apsa3->setLibelle("Saut en hauteur");
        $manager->persist($Apsa3);

        $Apsa4 = new Apsa();
        $Apsa4->setLibelle("Natation vitesse");
        $manager->persist($Apsa4);

        $Apsa5 = new Apsa();
        $Apsa5->setLibelle("Natation de distance");
        $manager->persist($Apsa5);

        $Apsa6 = new Apsa();
        $Apsa6->setLibelle("Lancer de javelot");
        $manager->persist($Apsa6);

        $Apsa7 = new Apsa();
        $Apsa7->setLibelle("Course de haie");
        $manager->persist($Apsa7);

        $Apsa8 = new Apsa();
        $Apsa8->setLibelle("Natation sauvetage");
        $manager->persist($Apsa8);

        $Apsa9 = new Apsa();
        $Apsa9->setLibelle("Course d'orientation");
        $manager->persist($Apsa9);

        $Apsa10 = new Apsa();
        $Apsa10->setLibelle("Acrosport");
        $manager->persist($Apsa10);

        $Apsa11 = new Apsa();
        $Apsa11->setLibelle("Art du cirque");
        $manager->persist($Apsa11);

        $Apsa12 = new Apsa();
        $Apsa12->setLibelle("Danse");
        $manager->persist($Apsa12);

        $Apsa13 = new Apsa();
        $Apsa13->setLibelle("Gymnastique au sol");
        $manager->persist($Apsa13);

        $Apsa14 = new Apsa();
        $Apsa14->setLibelle("Gymnastique rythmique");
        $manager->persist($Apsa14);

        $Apsa15 = new Apsa();
        $Apsa15->setLibelle("Gymnastique saut de cheval");
        $manager->persist($Apsa15);



        $Apsa16 = new Apsa();
        $Apsa16->setLibelle("Football");
        $manager->persist($Apsa16);

        $Apsa17 = new Apsa();
        $Apsa17->setLibelle("Handball");
        $manager->persist($Apsa17);

        $Apsa18 = new Apsa();
        $Apsa18->setLibelle("Rugby");
        $manager->persist($Apsa18);

        $Apsa19 = new Apsa();
        $Apsa19 ->setLibelle("Volley-ball");
        $manager->persist($Apsa19);



        $Apsa20 = new Apsa();
        $Apsa20->setLibelle("Course de durée");
        $manager->persist($Apsa20);

        $Apsa21 = new Apsa();
        $Apsa21->setLibelle("Natation de durée");
        $manager->persist($Apsa21);

        $Apsa22 = new Apsa();
        $Apsa22->setLibelle("Musculation");
        $manager->persist($Apsa22);

        $Apsa23 = new Apsa();
        $Apsa23->setLibelle("Relaxation");
        $manager->persist($Apsa23);

        $Apsa24 = new Apsa();
        $Apsa24 ->setLibelle("Step");
        $manager->persist($Apsa24);




        $champApprentissageApsa1 = new ChampsApprentissageApsa();
        $champApprentissageApsa1->setApsa($Apsa1);
        $champApprentissageApsa1->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa1);

        $champApprentissageApsa2 = new ChampsApprentissageApsa();
        $champApprentissageApsa2->setApsa($Apsa2);
        $champApprentissageApsa2->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa2);

        $champApprentissageApsa3 = new ChampsApprentissageApsa();
        $champApprentissageApsa3->setApsa($Apsa3);
        $champApprentissageApsa3->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa3);

        $champApprentissageApsa4 = new ChampsApprentissageApsa();
        $champApprentissageApsa4->setApsa($Apsa4);
        $champApprentissageApsa4->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa4);

        $champApprentissageApsa5 = new ChampsApprentissageApsa();
        $champApprentissageApsa5->setApsa($Apsa5);
        $champApprentissageApsa5->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa5);

        $champApprentissageApsa6 = new ChampsApprentissageApsa();
        $champApprentissageApsa6->setApsa($Apsa6);
        $champApprentissageApsa6->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa6);

        $champApprentissageApsa7 = new ChampsApprentissageApsa();
        $champApprentissageApsa7->setApsa($Apsa7);
        $champApprentissageApsa7->setChampApprentissage($ChampApprentissage1);
        $manager->persist($champApprentissageApsa7);

        $champApprentissageApsa8 = new ChampsApprentissageApsa();
        $champApprentissageApsa8->setApsa($Apsa8);
        $champApprentissageApsa8->setChampApprentissage($ChampApprentissage2);
        $manager->persist($champApprentissageApsa8);

        $champApprentissageApsa9 = new ChampsApprentissageApsa();
        $champApprentissageApsa9->setApsa($Apsa9);
        $champApprentissageApsa9->setChampApprentissage($ChampApprentissage2);
        $manager->persist($champApprentissageApsa9);

        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa10);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa11);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa11);

        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa12);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa13);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa11);


        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa14);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa15);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage3);
        $manager->persist($champApprentissageApsa11);


        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa16);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage4);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa17);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage4);
        $manager->persist($champApprentissageApsa11);


        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa18);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage4);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa19);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage4);
        $manager->persist($champApprentissageApsa11);



        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa20);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa11);


        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa21);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa22);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa11);


        $champApprentissageApsa10 = new ChampsApprentissageApsa();
        $champApprentissageApsa10->setApsa($Apsa23);
        $champApprentissageApsa10->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa10);

        $champApprentissageApsa11 = new ChampsApprentissageApsa();
        $champApprentissageApsa11->setApsa($Apsa24);
        $champApprentissageApsa11->setChampApprentissage($ChampApprentissage5);
        $manager->persist($champApprentissageApsa11);



        $Af1 = new Af();
        $Af1->setLibelle("Produire et répartir stratégiquement ses efforts");
        $Af1->setDescription("Produire et répartir stratégiquement ses efforts en mobilisant de façon optimale ses ressources pour gagner ou pour battre un record.");
        $Af1->setCa($ChampApprentissage1);
        $Af1->setTypeAf("AFLP BP");
        $manager->persist($Af1);

        $Af2 = new Af();
        $Af2->setLibelle("Connaître et utilser des techniques");
        $Af2->setDescription("Connaître et utiliser des techniques adaptées pour produire la meilleure performance possible.");
        $Af2->setCa($ChampApprentissage1);
        $Af2->setTypeAf("AFLP BP");
        $manager->persist($Af2);

        $Af3 = new Af();
        $Af3->setLibelle("Analyser sa performance");
        $Af3->setDescription("Analyser sa performance pour adapter son projet et progresser.");
        $Af3->setCa($ChampApprentissage1);
        $Af3->setTypeAf("AFLP BP");
        $manager->persist($Af3);

        $Af4 = new Af();
        $Af4->setLibelle("Assumer des rôles sociaux");
        $Af4->setDescription("Assumer des rôles sociaux pour organiser une épreuve de production de performance, un concours.");
        $Af4->setCa($ChampApprentissage1);
        $Af4->setTypeAf("AFLP BP");
        $manager->persist($Af4);

        $Af5 = new Af();
        $Af5->setLibelle("Assurer la prise en charge de sa préparation");
        $Af5->setDescription("Assurer la prise en charge de sa préparation et de celle d’un groupe, de façon autonome pour produire la meilleure performance possible");
        $Af5->setCa($ChampApprentissage1);
        $Af5->setTypeAf("AFLP BP");
        $manager->persist($Af5);

        $Af6 = new Af();
        $Af6->setLibelle("Connaître son niveau pour établir un projet");
        $Af6->setDescription("Connaître son niveau pour établir un projet de performance située culturellement.");
        $Af6->setCa($ChampApprentissage1);
        $Af6->setTypeAf("AFLP BP");
        $manager->persist($Af6);

        $Af7 = new Af();
        $Af7->setLibelle("Produire et répartir stratégiquement ses efforts");
        $Af7->setDescription("Produire et répartir stratégiquement ses efforts en mobilisant de façon optimale ses ressources pour gagner ou pour battre un record.");
        $Af7->setCa($ChampApprentissage2);
        $Af7->setTypeAf("AFLP BP");
        $manager->persist($Af7);

        $Af8 = new Af();
        $Af8->setLibelle("Connaître et mobiliser les techniques");
        $Af8->setDescription("Connaître et mobiliser les techniques efficaces pour produire la meilleure performance possible.");
        $Af8->setCa($ChampApprentissage2);
        $Af8->setTypeAf("AFLP BP");
        $manager->persist($Af8);

        $Af9 = new Af();
        $Af9->setLibelle("Connaître son niveau pour établir un projet");
        $Af9->setDescription("Produire et répartir intentionnellement ses efforts en mobilisant ses ressources pour gagner ou pour battre un record.");
        $Af9->setCa($ChampApprentissage1);
        $Af9->setTypeAf("AFLP CAP");
        $manager->persist($Af9);

        $Af10 = new Af();
        $Af10->setLibelle("Connaître et utiliser des techniques adaptées");
        $Af10->setDescription("Connaître et utiliser des techniques adaptées pour produire la meilleure performance possible.");
        $Af10->setCa($ChampApprentissage2);
        $Af10->setTypeAf("AFLP CAP");
        $manager->persist($Af6);

        $manager->flush();
    }
}
