<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = (new User())
            ->setCin("123456789")
            ->setEmail("admin@airpon.tn")
            ->setAdressePersonelle("adressePersonelle")
            ->setAdresseProfessionelle("adresseProfessionalle")
            ->setMatricule("admin")
            ->setPostTravail("xxxxxx")
            ->setRoles([UserRole::ADMIN->value])
            ->setTelFixe("123456789")
            ->setTelPortable("123456789");
        $admin->setPassword($this->hasher->hashPassword($admin, "admin"));
        $manager->persist($admin);

        $responsable = (new User())
            ->setCin("123456")
            ->setEmail("responsable@airpon.tn")
            ->setAdressePersonelle("adressePersonelle")
            ->setAdresseProfessionelle("adresseProfessionalle")
            ->setMatricule("responsable")
            ->setPostTravail("xxxxxx")
            ->setRoles([UserRole::RESPONSABLE->value])
            ->setTelFixe("123456789")
            ->setTelPortable("123456789");
        $responsable->setPassword($this->hasher->hashPassword($responsable, "responsable"));
        $manager->persist($responsable);

        $clientele = (new User())
            ->setCin("8979653")
            ->setEmail("clientele@airpon.tn")
            ->setAdressePersonelle("adressePersonelle")
            ->setAdresseProfessionelle("adresseProfessionalle")
            ->setMatricule("clientele")
            ->setPostTravail("xxxxxx")
            ->setRoles([UserRole::CLIENTELE->value])
            ->setTelFixe("123456789")
            ->setTelPortable("123456789");
        $clientele->setPassword($this->hasher->hashPassword($clientele, "clientele"));
        $manager->persist($clientele);



        $manager->flush();
    }
}