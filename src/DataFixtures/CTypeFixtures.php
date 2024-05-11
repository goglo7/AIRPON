<?php

namespace App\DataFixtures;

use App\Entity\CType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class  CTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subBox = (new CType())->setName("Sub box");
        $manager->persist($subBox);

        $endBox = (new CType())->setName("End box");
        $manager->persist($endBox);

        $manager->flush();
    }
}