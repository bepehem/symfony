<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1 ->setContent ("Super, cette nouvelle version");
        $comment1 ->setCreatedAt (new \DateTime("2019-05-12"));
        $comment1 ->setArticle($this->getReference("article-1"));
        $comment1-> setUser($this->getReference(("user-user2")));
        $manager->persist($comment1);

        $manager->flush();

        $comment2 = new Comment();
        $comment2 ->setContent ("J'aime la programmation");
        $comment2 ->setCreatedAt (new \DateTime("2014-10-28"));
        $comment2 ->setArticle($this->getReference("article-2"));
        $comment2-> setUser($this->getReference(("user-user2")));
        $manager->persist($comment2);

        $manager->flush();

        $comment3 = new Comment();
        $comment3 ->setContent ("Pas facile d'apprendre tout cela par coeur");
        $comment3 ->setCreatedAt (new \DateTime("2017-10-10"));
        $comment3 ->setArticle($this->getReference("article-2"));
        $comment3-> setUser($this->getReference(("user-admin1")));
        $manager->persist($comment3);

        $manager->flush();

        $comment4 = new Comment();
        $comment4 ->setContent ("J'adore l'art abstrait");
        $comment4 ->setCreatedAt (new \DateTime("2018-03-21"));
        $comment4 ->setArticle($this->getReference("article-3"));
        $comment4-> setUser($this->getReference(("user-user2")));
        $manager->persist($comment4);

        $manager->flush();

        $comment5 = new Comment();
        $comment5 ->setContent ("Fun fun fun");
        $comment5 ->setCreatedAt (new \DateTime("2017-11-07"));
        $comment5 ->setArticle($this->getReference("article-4"));
        $comment5-> setUser($this->getReference(("user-admin1")));
        $manager->persist($comment5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class,
            UserFixtures::class
        ];
    }
}
