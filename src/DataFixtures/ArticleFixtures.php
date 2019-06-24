<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setTitle("Nouvelle version de PHP");
        $article1->setPicture("php.jpg");
        $article1->setContent("J'me balladais sur l'avenue");
        $article1->setCategory($this->getReference("cat-devweb"));
        $article1->addTag($this->getReference("tag-PHP"));

        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle("Créer un site PHP");
        $article2->setPicture("site.jpg");
        $article2->setContent("Ca s'en va et ça revient");
        $article2->setCategory($this->getReference("cat-devweb"));
        $article2->addTag($this->getReference("tag-HTML"));
        $article2->addTag($this->getReference("tag-CSS"));
        $article2->addTag($this->getReference("tag-PHP"));
        $article2->addTag($this->getReference("tag-MySQL"));

        $manager->persist($article2);

        $article3 = new Article();
        $article3->setTitle("Utiliser Photoshop");
        $article3->setPicture("photoshop.jpg");
        $article3->setContent("Laissons entrer le soleil");
        $article3->setCategory($this->getReference("cat-design"));

        $manager->persist($article3);

        $manager->persist($article2);


        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TagFixtures::class,
        ];
    }
}
