<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Entity\Formation;
use AppBundle\Repository\FormationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ReCaptcha\ReCaptcha;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function competencesAction(){
        //Acces au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entitee
        $competencesRepository = $em->getRepository('AppBundle:Competences');
        //Recuperartion de l'ensemble des données liees à l'entitée.
        $competencesList = $competencesRepository->findAll();
        $message = ['Adresse : 148 Avenue Jean Jaures 93500 Pantin' , 'Telephone : 06.45.95.38.56' , 'Email : lutmickael@gmail.com'];

        $descriptionRepository = $em->getRepository('AppBundle:professional_status');
        $descriptionList = $descriptionRepository->findAll();

        return $this->render('@App/base/index.html.twig', array(
            'competencesList' => $competencesList,
            'message' => $message,
            'description'=> $descriptionList,
        ));
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request){

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            //Instanciation swift_Mailer
            $message = \Swift_Message::newInstance()
                ->setSubject('Validation de votre message')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setTo($contact->getEmail())
                ->setFrom(array('lutmickael@gmail.com'=>"Lutin Mickael"))
                ->setBody($this->renderView('@App/Swift_layout/validation.html.twig',array('contact' => $contact)));
            //dump($message);die();
            $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre message a bien ete envoyé');

            return $this->redirectToRoute('contact');

        }
        return $this->render('@App/contact/contact.html.twig', array(
            'contact' => $form->createView(),
      ));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/formation", name="formation")
     */
    public function formationAction(){

        //Acces au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entitee
        $formationRepository = $em->getRepository('AppBundle:Formation');

        //Recuperartion de l'ensemble des données liees à l'entitée.
        $formationList = $formationRepository->findAll();
        //dump($formationList);die();
        return $this->render('@App/formation/formation.html.twig', array(
            'formationList' => $formationList
        ));
    }


    /**
     * @Route("/formation/{formation}" , name="image")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function imageFormationAction($formation){
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        
        $imageRepository = $em->getRepository('AppBundle:Formation');
       
        $imageFormation = $imageRepository->findOneByid($formation);
        
        return $this->render('@App/formation/formationImage.html.twig', array(
            'imageFormation' => $imageFormation
        ));
    }
    

    /**
     * @Route("/experience", name="experience")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function experienceAction(){

        //Acces au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entitee
        $experienceRepository = $em->getRepository('AppBundle:Experience');

        //Recuperartion de l'ensemble des données liees à l'entitée.
        $experienceList = $experienceRepository->findAll();
        //dump($formationList);die();
        return $this->render('@App/experiences/experience.html.twig', array(
            'experienceList' => $experienceList
        ));
    }

    /**
     * @Route("/experience/{experience}" , name="experience-detail")
     * @param $idExperience
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($experience)
    {
        //Accès au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        //Acces au repository de l'entite
        $experienceRepository = $em->getRepository('AppBundle:Experience');
        //Recupération du resultat de la requete en fonction de l'argument âssé en paramètre.
        $detailExperience = $experienceRepository->findOneByid($experience);

        //Renvoi vers page detail avec tableau contenant le resultat.
        return $this->render('@App/experiences/description.html.twig', array(
            'detailExperience' => $detailExperience
        ));
    }

}
