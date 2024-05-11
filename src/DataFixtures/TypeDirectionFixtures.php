<?php

namespace App\DataFixtures;

use App\Entity\TypeDirection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeDirectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generale = (new TypeDirection())->setName("Générale");
        $manager->persist($generale);

        $centrale = (new TypeDirection())->setName("Centrale");
        $manager->persist($centrale);

        $regionale = (new TypeDirection())->setName("Régionale");
        $manager->persist($regionale);

        $zone = (new TypeDirection())->setName("Zone");
        $manager->persist($zone);

        $tt = (new TypeDirection())->setName("TT");
        $manager->persist($tt);

        $subCentrale = (new TypeDirection())->setName("Sub centrale");
        $manager->persist($generale);


        $manager->flush();
    }
}