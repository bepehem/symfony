<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new", name="article_new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, Slugger $slugger)
    {
        $article =new Article();

        $form= $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $pictureFile */
            $pictureFile =$form["pictureFile"]->getData();

            if($pictureFile){
                $filename = uniqid() . "." . $pictureFile->guessExtension();

                $pictureFile->move($this->getParameter("upload_dir"), $filename);

                $article->setPicture($filename);
            }

            $article->setSlug($slugger->slugify($article->getTitle()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute("article_show", ["slug" =>$article->getSlug()]);

        }

        return $this->render('article/new.html.twig',[
            'form' =>$form->createView()
        ]);
    }

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
