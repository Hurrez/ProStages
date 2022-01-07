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
        $nombreFormations=15;
        for ($i=1;$i <= $nombreFormations;$i++)
        {
            $formation = new Formation();
            $formation->setNomCourt($faker->realText($maxNbChars=15,$indexSize=2));
            $formation->setNomLong($faker->realText($maxNbChars=50,$indexSize=2));
            $formations[]=$formation;    
            $manager->persist($formation);
        }
        
        //Création entreprises
        $nombreEntreprises=15;
        for ($i=1;$i<=$nombreEntreprises;$i++)
        {
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setAdresse($faker->address);
            $entreprise->setActivite($faker->realText($maxNbChars=35,$indexSize=2));
            $entreprise->setSiteweb($faker->url());
            $entreprises[]=$entreprise;
            $manager->persist($entreprise);
        }

        //Création stages
        $nombreStages=50;
        for($i=1;$i<=$nombreStages;$i++)
        {
            $stage = new Stage();
            $stage->setTitre($faker->realText($maxNbChars=25,$indexSize=2));
            $stage->setMission($faker->realText($maxNbChars=150,$indexSize=2));
            $stage->setEmail($faker->email());
            $stage->setEntreprise($entreprises[$faker->numberBetween($min=0,$max=count($entreprises)-1)]);
            $stage->addFormation($formations[$faker->numberBetween($min=0,$max=count($formations)-1)]);
            $manager->persist($stage);
        }

        //envoyer en bd
        $manager->flush();
    }
}
