<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use P5indicatori\UserBundle\Form\Type\TrackingType;
use P5indicatori\UserBundle\Form\Type\TrackingSourcesType;
use P5indicatori\UserBundle\Document\User;
use P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Jira\Jira4;

class DefaultController extends Controller
{
    /**
     * Home page action
     * @return array
     */
    public function indexAction()
    {
        
        $formTrackingTypes = $this->createForm(new TrackingType($this->container));
        
        return $this->render('P5indicatoriUserBundle:Default:index.html.twig', 
                array(
                    'form' => $formTrackingTypes->createView()
                ));
    }
    
    /**
     * Display user sources and selectbox to add another tracking source.
     * @return array
     */
    public function selectedTrackingTypeAction() {
        $postedElements = $this->getRequest()->request->all();
        
        if(empty($postedElements)){
            return $this->redirect($this->generateUrl('p5indicatori_user_homepage'));
        }
        $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container,$postedElements));
        $pageTitle = 'Sources, add source';
        return $this->render('P5indicatoriUserBundle:Sources:user_sources.html.twig', array(
                    'form' => $formSourcesTracking->createView(),
                    'page_title' => $pageTitle
        ));
    }
   
}
