<?php


namespace App\Controller;

use App\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClubType;
//use Symfony\Component\Form\Extension\core\Type\DateTime;
class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    /**
     * @Route("afficherC", name="afficherC")
     */
    public function afficherClub(): Response{

        $list = $this->getDoctrine()->getRepository(Club::class)->findAll();
        return $this->render('club/clubs.html.twig',[
            'clubs' => $list,
        ]);

    }

        /**
     * @Route("supprimerC/{id}", name="supprimerC")
     */
    public function supprimerClub($id): Response{

        $club =$this->getDoctrine()->getRepository(Club::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('afficherC');

    }

       /**
     * @Route("showC/{id}", name="showC")
     */
    public function showClub($id): Response{

        $club =$this->getDoctrine()->getRepository(Club::class)->find($id);

        return $this->render('club/show.html.twig',[
            'club' =>$club,
        ]);

    }


    /**
     * @Route("addC", name="addC")
     */
    public function addClub(Request $request): Response{

        $club =new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('afficherC');
        }
        return $this->render('club/add.html.twig',[
            'formClub' =>$form->createView(),
        ]);

    }


       /**
     * @Route("updateC/{id}", name="updateC")
     */
    public function updateClub(Request $request, $id): Response{

        $club = $this->getDoctrine()->getRepository(club::class)->find($id);
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficherC');
        }
        return $this->render('club/update.html.twig',[
            'formClub' =>$form->createView(),
         ]);
    }

}
