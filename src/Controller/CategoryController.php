<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */

class CategoryController extends AbstractController
{
    /**
     * @Route("/{id}", name="category_show", requirements={"id": "\d+"})
     */
    public function show(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
    /**
     * @Route("/new", name="category_new")
     */
    public function new(Request $request)
    {
        // Créer nouvel objet Category
        $category = new Category();

        // Créer formulaire pour ajouter nouvelle categorie
        $form = $this->createForm(CategoryType::class, $category);

        // Mettre à jour formulaire s'il a été envoyé
        $form->handleRequest($request);

        //Vérifier si formulaire est valide
        if ($form->isSubmitted() && $form->isValid()){
            $category=$form->getData();

            $em =$this->getDoctrine()->getManager();
            $em ->persist($category);
            $em ->flush();

            return $this->redirectToRoute('homepage');
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll ([], ['label' => 'ASC']);

        //Valider formulaire
        return $this->render("category/new.html.twig", [
            'form' =>$form->createView(),
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_edit", methods={"GET", "POST"})
     */
    public function edit(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $form->getData();

            $em =$this->getDoctrine()->getManager();
            $em ->persist($category);
            $em ->flush();

            return $this->redirectToRoute('category_new');
        }

        return $this->render("category/edit.html.twig", [
            'form' => $form->createView(),
            'category' => $category
            ]);
    }
}
