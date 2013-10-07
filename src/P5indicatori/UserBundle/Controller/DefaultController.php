<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use P5indicatori\UserBundle\Form\Type\TrackingType;
use P5indicatori\UserBundle\Form\Type\TrackingSourcesType;
use P5indicatori\UserBundle\Document\User;
use P5indicatori\UserBundle\Document\Project;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigsAbstract;
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
    public function selectedTrackingTypeAction($tracking_type) {
        $postedElements = $this->getRequest()->request->all();
        
        if(empty($postedElements) && empty($tracking_type)){
            return $this->redirect($this->generateUrl('p5indicatori_user_homepage'));
        }elseif(!empty($tracking_type) && empty($postedElements)){
            $postedElements['tracking_sources_types_form']['tracking_types'] = $tracking_type;
        }
        
        $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container,$postedElements), new Project());
        
        $pageTitle = 'Sources, add source';
        return $this->render('P5indicatoriUserBundle:Sources:user_sources.html.twig', array(
                    'form' => $formSourcesTracking->createView(),
                    'page_title' => $pageTitle
        ));
    }
    
    /**
     * Add tracking sources to user.
     * @return type
     */
    public function addUserSourceAction(){
        $postedElements = $this->getRequest()->request->all();

        if (empty($postedElements)) {
            return $this->redirect($this->generateUrl('p5indicatori_user_homepage'));
        }
        $dm = $this->get('doctrine_mongodb')->getManager();
       
        $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container,$postedElements), new Project());
       
        $formSourcesTracking->handleRequest($this->getRequest());

        if ($formSourcesTracking->isValid()) {
            $registration = $formSourcesTracking->getData();

            $dm->persist($registration);
            $dm->flush();
            $tracking_type = $postedElements['tracking_sources_types_form']['tracking_types'];

            return $this->redirect($this->generateUrl('p5indicatori_get_user_trakings_sources',
                    array(
                        'tracking_type' => $tracking_type)));
        }

        return $this->render('P5indicatoriUserBundle:Sources:user_sources.html.twig', array(
                    'form' => $formSourcesTracking->createView(),
                    'page_title' => 'Is not valid.'
        ));
    }
   
}
