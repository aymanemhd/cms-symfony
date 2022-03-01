<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    /**
     * @Route("/", name="section")
     */
    public function index(): Response
    {
        return $this->render('section/index.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }
     /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }

     /**
     * @Route("/resume", name="resume")
     */
    public function resume(): Response
    {
        return $this->render('education/education.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }

   
      /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }

     /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('login/login.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }




     /**
     * @Route("/resume", name="resume")
     */
    public function AddResume(): Response
    {
        $section=new Section();
        $formBuilder = $this->createFormBuilder($data,$options);
        $formBuilder
            ->add('sommary')
            ->add('education')
            ->add('experience')
            ->getForm();


            return $this->render('education/education.html.twig', [
                'controller_name' => 'SectionController',
            ]);
    }



     /**
     * @Route("/resume/{id}/edit", name="resume")
     */
    public function DeleteResume(): Response
    {
        $section=new Section($id);
        $formBuilder = $this->createFormBuilder($data,$options);
        $man = $this->getDoctrine()->getManager();
        $man->remove($section);
        $man->flush();

        return $this->render('education/education.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }

     /**
     * @Route("/resume/{id}/delete", name="resume")
     */
    public function EditResume($id): Response
    {
        $section=new Section();
        $formBuilder = $this->createFormBuilder($data,$options);
        if($formBuilder->isSubmitted() && $formBuilder->isValid()) {
            $man = $this->getDoctrine()->getManager();
            $man->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('education/education.html.twig', [
            'controller_name' => 'SectionController',
        ]);

        
    }



    


}
