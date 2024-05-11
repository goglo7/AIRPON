<?php

namespace App\DataFixtures;

use App\Entity\PositionOlt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PositionOltFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $indoor = (new PositionOlt())->setName("Indoor");
        $manager->persist($indoor);

        $outdoor = (new PositionOlt())->setName("Outdoor");
        $manager->persist($outdoor);

        $manager->flush();
    }
}