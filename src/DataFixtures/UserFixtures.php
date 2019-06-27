<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin1 = new User();
        $admin1 -> setEmail ("p.martin@yahoo.fr");
        $admin1->setPassword($this->encoder->encodePassword($admin1,"1234"));
        $admin1->setRoles(['ROLE_ADMIN']);
        $this->setReference("user-admin1",$admin1);

        $manager->persist($admin1);

        $user2 = new User();
        $user2 -> setEmail ("j.doe@gmail.com");
        $user2->setPassword($this->encoder->encodePassword($user2,"1234"));
        $this->setReference("user-user2",$user2);

        $manager->persist($user2);

        $manager->flush();
    }

}
