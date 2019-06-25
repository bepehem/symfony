<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tag;

class TagController extends AbstractController
{
    /**
     * @Route("/tag/{id}", name="tag_show", requirements={"id=\d+"}, methods={"GET"})
     */
    public function show(Tag $tag)
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }
}
