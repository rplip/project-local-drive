<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\localDriveProvider;
use Faker\Factory as FakerGeneratorFactory;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Faker\Provider\AliceProvider;
use Nelmio\Alice\Loader\NativeLoader;

class localDriveNativeLoader extends NativeLoader
{
    protected function createFakerGenerator(): FakerGenerator
    {
        $generator = FakerGeneratorFactory::create('fr_FR');

        // On ajoute notre nouveau provider en passant le generator dans le constructeur de notre classe (heritée du parent base)
        $generator->addProvider(new localDriveProvider($generator));
        $generator->seed($this->getSeed());

        return $generator;
    }
}