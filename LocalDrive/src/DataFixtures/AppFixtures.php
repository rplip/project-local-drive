<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use Faker\ORM\Doctrine\Populator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new localDriveNativeLoader();

        //importe le fichier de fixtures et récupère les entités générés
        $entities = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        
        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {
            $manager->persist($entity);
        };

        //enregistre
        $manager->flush();
    }
}
