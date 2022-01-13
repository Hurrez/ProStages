<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données faker
        $faker = \Faker\Factory::create('fr_FR');
       
        //Création formations
        $nombreFormations=5;
        //Déclaration de tableaux permettant de définir des noms voulu aux formations
        $tableauFormationsLong = array("DUT Informatique","DUT Gestion Entreprise Administration","Licence Prog Avancée","BTS Electronique","Licence Pro Numérique");
        $tableauFormationsCourt = array("Info","GEA","Prog Avancée","Electronique","LP Num");
        for ($i=0;$i<$nombreFormations;$i++)
        {
            $formation = new Formation(); //Création d'une nouvelle formation
            $formation->setNomCourt($tableauFormationsCourt[$i]);
            $formation->setNomLong($tableauFormationsLong[$i]);

            //Tableau contenant toutes les formations
            $formations[]=$formation;   

            $manager->persist($formation); //enregistrement en bd
        }
        
        //Création entreprises
        $nombreEntreprises=15;
        for ($i=0;$i<$nombreEntreprises;$i++)
        {
            $entreprise = new Entreprise(); //Création d'une nouvelle entreprise
            $entreprise->setNom($faker->company);
            $entreprise->setAdresse($faker->address);
            $entreprise->setActivite($faker->realText($maxNbChars=35,$indexSize=2));
            $entreprise->setSiteweb($faker->url);

            //Tableau contenant toutes les entreprises
            $entreprises[]=$entreprise; 

            $manager->persist($entreprise); //enregistrement en bd
        }

        //Création stages
        $nombreStages=25;
        //Tableaux permettant de définir aléatoiremenbt 
        $tableauMetier = array("Développeur","Pentester","Stagiaire","Codeur","Algorithmicien","Déchet");
        $tableauLangage = array("C++","java","C","HTML","PHP","Symfony","Base de données","Reseau","Java script");
        for($i=0;$i<$nombreStages;$i++)
        {
            $maxFormation = $faker->numberBetween($min=1,$max=3); //Création d'un nombre aléatoire définissant le nombre de formations qu'aura le stage
            $stage = new Stage(); //Création d'un nouveau stage
            $stage->setTitre($tableauMetier[($faker->numberBetween($min=0,$max=count($tableauMetier)-1))]." en ".$tableauLangage[($faker->numberBetween($min=0,$max=count($tableauLangage)-1))]); //génération d'un titre avec les tableaux
            $stage->setMission($faker->realText($maxNbChars=150,$indexSize=2));
            $stage->setEmail($faker->email());

            //Attribution d'une entreprise aléatoirement
            $stage->setEntreprise($entreprises[$faker->numberBetween($min=0,$max=count($entreprises)-1)]);

            //Attribution des formations aléatoirement
            for($j=0;$j<$maxFormation;$j++)
            {
                $formation = $faker->unique->numberBetween($min=0,$max=4);
                $stage->addFormation($formations[$formation]);
            }
            $faker->unique($reset = true);
            
            $manager->persist($stage); //enregistrement en bd
        }

        //envoyer en bd
        $manager->flush(); //Implementation
    }
}
