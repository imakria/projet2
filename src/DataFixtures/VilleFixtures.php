<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $ville = new Ville();
            $ville->setNom($faker->city);
            $ville->setCodePostal($faker->randomNumber(5));
            $manager->persist($ville);

        }
        $manager->flush();
    }
}
