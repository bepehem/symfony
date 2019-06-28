<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{slug}", name="article_show", methods={"GET"})
     */
    public function show(Article $article)
    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['article'=>$article],['createdAt'=> 'DESC']);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}
