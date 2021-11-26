<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="teacher")
     */
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => '5SE4',
        ]);
    }

    /**
     * @Route("/afficher", name="afficher")
     */
    public function afficher(): Response
    {
        return new Response("Bonjour !!!");
    }

    /**
     * @Route("/afficher/{nom}", name="afficher")
     */
    public function afficherNom($nom): Response
    {
        $heure = (new \DateTime) ->format('d/m/Y');
        return $this->render('teacher/afficher.html.twig', 
        [
            'name' => $nom,
            'class' => "5SE4",
            'heure' => $heure,
        ]);
    }
}
