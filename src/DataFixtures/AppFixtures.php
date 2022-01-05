<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données faker
        $faker = \Faker\Factory::create('fr_FR');
        
        $nbFormations=15;

        for ($i=1;$i <= $nbFormations;$i++){
            $dutInformatique = new Formation();
            $dutInformatique->setNomCourt($faker->realText($maxNbChars=15,$indexSize=2));
            $dutInformatique->setNomLong($faker->realText($maxNbChars=50,$indexSize=2));       
            $manager->persist($dutInformatique);
        }
        
        //envoyer en bd
        $manager->flush();
    }
}
