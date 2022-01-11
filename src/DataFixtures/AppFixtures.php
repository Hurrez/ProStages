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
        $tableauFormationsLong = array("DUT Informatique","DUT Gestion Entreprise Administration","Licence Prog Avancée","BTS Electronique","Licence Pro Numérique");
        $tableauFormationsCourt = array("Info","GEA","Prog Avancée","Electronique","LP Num");

        //Création formations
        $nombreFormations=5;
        for ($i=0;$i<$nombreFormations;$i++)
        {
            $formation = new Formation();
            $formation->setNomCourt($tableauFormationsCourt[$i]);
            $formation->setNomLong($tableauFormationsLong[$i]);
            $formations[]=$formation;    
            $manager->persist($formation);
        }
        
        //Création entreprises
        $nombreEntreprises=15;
        for ($i=0;$i<$nombreEntreprises;$i++)
        {
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setAdresse($faker->address);
            $entreprise->setActivite($faker->realText($maxNbChars=35,$indexSize=2));
            $entreprise->setSiteweb($faker->url);
            $entreprises[]=$entreprise;
            $manager->persist($entreprise);
        }

        //Création stages
        $nombreStages=25;
        for($i=0;$i<$nombreStages;$i++)
        {
            $maxFormation = $faker->numberBetween($min=1,$max=3);
            $stage = new Stage();
            $stage->setTitre($faker->realText($maxNbChars=25,$indexSize=2));
            $stage->setMission($faker->realText($maxNbChars=150,$indexSize=2));
            $stage->setEmail($faker->email());
            $stage->setEntreprise($entreprises[$faker->numberBetween($min=0,$max=count($entreprises)-1)]);
            for($j=0;$j<$maxFormation;$j++)
            {
                $formation = $faker->unique->numberBetween($min=0,$max=4);
                $stage->addFormation($formations[$formation]);
            }
            $faker->unique($reset = true);
            $manager->persist($stage);
        }

        //envoyer en bd
        $manager->flush();
    }
}
