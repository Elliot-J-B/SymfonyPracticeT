<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
         // Utilisateur 'user' avec le r$ole 'ROLE_USER'
         $user = new User();
         $user->setEmail('user@example.com');
         $user->setisverified(true);
         $user->setroles(['ROLE_USER']);
         $user->setPassword($this->userPasswordHasher->hashPassword($user, 'user'));
         $manager->persist($user);

         // Utilisateur 'user' avec le r$ole 'ROLE_ADMIN'
         $admin = new User();
         $admin->setEmail('admin@example.com');
         $admin->setisverified(true);
         $admin->setroles(['ROLE_ADMIN']);
         $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'admin'));
         $manager->persist($admin);

         // Utilisateur 'user' avec le r$ole 'ROLE_SUPER_ADMIN'
         $superAdmin = new User();
         $superAdmin->setEmail('superadmin@example.com');
         $superAdmin->setisverified(true);
         $superAdmin->setroles(['ROLE_SUPER_ADMIN']);
         $superAdmin->setPassword($this->userPasswordHasher->hashPassword($superAdmin, 'superadmin'));
         $manager->persist($superAdmin);


         $manager->flush();
    }
}
