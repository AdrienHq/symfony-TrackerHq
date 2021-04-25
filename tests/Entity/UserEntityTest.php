<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserEntityTest extends KernelTestCase
{

    public function createTestEntity(){
        return ($user = (new User())
            ->setEmail("fixEmail@fix")
            ->setRoles(['ROLE_USER'])
            ->setPassword("fixPass")
            ->setFirstname("fixFirstName")
            ->setAge(20)
            ->setName("fixName")
            ->setHeight(160)
            ->setWeight(100)
            ->setActivity(0)
            ->setGender(0));
    }

    public function hasError(User $user, int $error = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($user);
        $this->assertCount(0, $error);
    }

    public function testValidity()
    {
        $this->hasError($this->createTestEntity(), 0);  
    }

    public function testConstructor()
    {
        $userTest = $this->createTestEntity();

        $this->assertSame($userTest->getEmail(),"fixEmail@fix");
        $this->assertSame($userTest->getRoles(),['ROLE_USER']);
        $this->assertSame($userTest->getPassword(),"fixPass");
        $this->assertSame($userTest->getFirstname(),"fixFirstName");
        $this->assertSame($userTest->getAge(),20);
        $this->assertSame($userTest->getName(),"fixName");
        $this->assertSame($userTest->getHeight(),160);
        $this->assertSame($userTest->getWeight(),100);
        $this->assertSame($userTest->getActivity(),0);
        $this->assertSame($userTest->getGender(),0);
    }
}