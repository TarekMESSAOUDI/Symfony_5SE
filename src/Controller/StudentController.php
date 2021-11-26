<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student;
use App\Entity\Classroom;
use Symfony\Component\HttpFoundation\Request;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use App\Form\SearchStudentType;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

     /**
     * @Route("afficherSt", name="afficherSt")
     */
    public function afficherStudent(Request $request,StudentRepository $Repository): Response{

        $list = $this->getDoctrine()->getRepository(Student::class)->findAll();
        $SearchForm = $this->createForm(SearchStudentType::class);
        $SearchForm->handleRequest($request);
        if($SearchForm->isSubmitted() && $SearchForm->isValid()){
            $email = $SearchForm->getData()->getEmail();
            $Result = $Repository->SearchStudentByEmail($email);
            return $this->render('student/student.html.twig',[
            'students' => $Result, 'form' => $SearchForm->createView()]);
        }
        return $this->render('student/student.html.twig',[
            'students' => $list,'form' => $SearchForm->createView()
        ]);

    }


    /**
     * @Route("addSt", name="addStt")
     */
    public function addStudent(Request $request): Response{

        $student =new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('afficherSt');
        }
        return $this->render('student/add.html.twig',[
            'formStudent' =>$form->createView(),
        ]);
}
}
