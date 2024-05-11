<?php

namespace App\DataFixtures;

use App\Entity\TypeOlt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeOltFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ma5800x1 = (new TypeOlt())->setName("MA5800X1");
        $manager->persist($ma5800x1);

        $ma5800x2 = (new TypeOlt())->setName("MA5800X2");
        $manager->persist($ma5800x2);

        $ma5800x7 = (new TypeOlt())->setName("MA5800X7");
        $manager->persist($ma5800x7);

        $bland = (new TypeOlt())->setName("Bland");
        $manager->persist($bland);

        $pizza = (new TypeOlt())->setName("Pizza");
        $manager->persist($pizza);

        $manager->flush();
    }
}