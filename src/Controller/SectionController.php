<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use\App\Repository\SectionRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Section;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\SectionType;

class SectionController extends AbstractController
{
    public function __constract(EntityManagerInterface $em){
        $this->em=$em;
    }
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
     * @Route("/education", name="education")
     */
    public function education(SectionRepository $sectionRepository): Response
    {
        $section=$sectionRepository->findAll();
        return $this->render('education/education.html.twig', [
            'section' => $section,
        ]);
    }

    /**
     * @Route("/experience", name="experience")
     */
    public function experience(SectionRepository $sectionRepository): Response
    {
        $section=$sectionRepository->findAll();
        return $this->render('experience/experience.html.twig', [
            'section' => $section,
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

    

    //experience


     /**
     * @Route("/experience/create",name="ajouterexperience" )
     */
    public function ajouterexperience(Request $request) {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();
        $this->addFlash('success','jghggh');
           return $this->redirectToRoute('section');

        }
        return $this->render('experience/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/experience/update/{id}",name="modifierexperience" )
     */
    public function modifierxperience(Request $request,$id) {
        $section = $this->getDoctrine()->getRepository(Section::class);
        $section = $section->find($id);
        $form = $this->createFormBuilder($section)
            ->add('subtitle')
            ->add('date')
            ->add('description')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $section = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();
        }
        return $this->render('experience/update.html.twig', [
            'controller_name' => 'SectionController',
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/experience/{id}", name="supprimerexperience")
     */
    public function supprimerexperience(Request $request,$id): Response
    {
        $section = $this->getDoctrine()->getRepository(Section::class);
        $section = $section->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($section);
        $em->flush();
        $this->addFlash('update','jghggh');
        return $this->redirectToRoute('main');
    }


    



   //education

    /**
     * @Route("/education/create",name="ajouteducation" )
     */
    public function ajoutereducation(Request $request) {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();
        $this->addFlash('success','jghggh');
           return $this->redirectToRoute('section');

        }
        return $this->render('education/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/education/update/{id}",name="modifieducation" )
     */
    public function modifieducation(Request $request,$id) {

        $section = $this->getDoctrine()->getRepository(Section::class);
        $section = $section->find($id);
        $form = $this->createFormBuilder($section)
            ->add('subtitle')
            ->add('date')
            ->add('description')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $section = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();
        }
        return $this->render('education/update.html.twig', [
            'controller_name' => 'SectionController',
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/education/{id}", name="supprimereducation")
     */
    public function supprimereducation(Request $request, Section $section): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($section);
            $em->flush();
        }

        return $this->redirectToRoute('supprimereducation');

        return $this->render('education/education.html.twig', [
            'controller_name' => 'SectionController',
            'formSection' => $form->createView()
        ]);
    }



}

