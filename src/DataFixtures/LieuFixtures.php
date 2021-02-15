<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LieuFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $lieu = new Lieu();
            $lieu->setNom($faker->city);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $manager->persist($lieu);

        }
        $manager->flush();
    }
}
