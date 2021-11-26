<?php

Namespace App\Controller;
use App\Repository\ClassroomRepository;
use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

     /**
     * @Route("afficherCr", name="afficherCr")
     */
    public function afficherClassroom(): Response{

        $list = $this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render('classroom/classrooms.html.twig',[
            'classrooms' => $list,
        ]);

    }

        /**
     * @Route("supprimerCr/{id}", name="supprimerCr")
     */
    public function supprimerClassroom($id): Response{

        $classroom =$this->getDoctrine()->getRepository(Classroom::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('afficherCr');;

    }

       /**
     * @Route("showCr/{id}", name="showCr")
     */
    public function showClassroom($id): Response{

        $classroom =$this->getDoctrine()->getRepository(Classroom::class)->find($id);
        return $this->render('classroom/show.html.twig',[
            'classroom' =>$classroom,
        ]);

    }
}
