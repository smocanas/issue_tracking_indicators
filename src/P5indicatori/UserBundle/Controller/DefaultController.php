<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use P5indicatori\UserBundle\Form\Type\TrackingVersionsType;
use P5indicatori\UserBundle\Document\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $formVersionsTracking = $this->createForm(new TrackingVersionsType($this->container));
        
        return $this->render('P5indicatoriUserBundle:Default:index.html.twig', 
                array(
                    'form' => $formVersionsTracking->createView()
                ));
    }
   
}
