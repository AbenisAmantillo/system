<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername('Abenis Amantillo');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, '202303607');
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $staff = new User();
        $staff->setUsername('Jemar Mananquil');
        $staff->setRoles(['ROLE_STAFF']);
        $hashedPassword = $this->passwordHasher->hashPassword($staff, 'Jemar123');
        $staff->setPassword($hashedPassword);
        $manager->persist($staff);

        $manager->flush();
    }
}
