<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <10; $i ++){
            $user = (new User())
                ->setEmail("fixEmail$i@fix")
                ->setRoles(['ROLE_USER'])
                ->setPassword("fixPass$i")
                ->setFirstname("fixFirstName$i")
                ->setAge($i)
                ->setName("fixName$i")
                ->setHeight($i)
                ->setWeight($i)
                ->setActivity(0)
                ->setGender(0);
            $manager->persist($user);
        }
        $manager->flush();
    }
}