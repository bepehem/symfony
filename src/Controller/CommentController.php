<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Article;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/{id}/new", name="comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="comment_new", methods={"GET","POST"})
     */
    public function new(Article $article, Request $request): Response
    {
        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setUser($this->getUser());

        $actionUrl = $this->generateUrl('comment_new', ['id'=> $article->getId()]);
        $form = $this->createForm(CommentType::class, $comment, ['action' => $actionUrl]);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si utilisateur est connecté
            if (!$this->getUser()) {
            throw $this-> createAccessDeniedException('Accès refusé.');
}
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('article_show', ['id' =>$article->getId()]);
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index', [
                'id' => $comment->getId(),
            ]);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index');
    }
}
