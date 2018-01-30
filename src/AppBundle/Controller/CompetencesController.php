<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Competences;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Competence controller.
 *
 * @Route("competences")
 */
class CompetencesController extends Controller
{
    /**
     * Lists all competence entities.
     *
     * @Route("/", name="competences_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $competences = $em->getRepository('AppBundle:Competences')->findAll();

        return $this->render('competences/index.html.twig', array(
            'competences' => $competences,
        ));
    }

    /**
     * Finds and displays a competence entity.
     *
     * @Route("/{id}", name="competences_show")
     * @Method("GET")
     */
    public function showAction(Competences $competence)
    {

        return $this->render('competences/show.html.twig', array(
            'competence' => $competence,
        ));
    }
}
