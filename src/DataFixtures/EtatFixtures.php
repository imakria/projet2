<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();


            $etat = new Etat();
            $etat->setLibelle("Cree");
            $manager->persist($etat);

        $etat = new Etat();
        $etat->setLibelle("Ouverte");
        $manager->persist($etat);

        $etat = new Etat();
        $etat->setLibelle("Cloturee");
        $manager->persist($etat);

        $etat = new Etat();
        $etat->setLibelle("Activite en cours");
        $manager->persist($etat);

        $etat = new Etat();
        $etat->setLibelle("Passee");
        $manager->persist($etat);

        $etat = new Etat();
        $etat->setLibelle("Annulee");
        $manager->persist($etat);

        $manager->flush();
    }
}
