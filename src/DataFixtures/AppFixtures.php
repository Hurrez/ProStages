<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dutInformatique = new Formation();
        $dutInformatique->setNomCourt("DUTInfo");
        $dutInformatique->setNomLong("Diplôme Universitaire Technologique Informatique");
        $manager->persist($dutInformatique);

        $manager->flush();
    }
}
