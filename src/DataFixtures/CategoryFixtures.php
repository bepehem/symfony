<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $devweb = new Category();
       $devweb->setLabel("Developpement web");
       $manager->persist($devweb);
       $this->setReference("cat-devweb", $devweb);

       $design = new Category();
       $design->setLabel("Design");
       $manager->persist($design);
       $this->setReference("cat-design", $design);

       $bdd = new Category();
       $bdd->setLabel("Base de données");
       $manager->persist($bdd);
       $this->setReference("cat-bdd", $bdd);


        $manager->flush();
    }
}
