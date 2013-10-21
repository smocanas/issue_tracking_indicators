<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use P5indicatori\UserBundle\Form\Type\TrackingType;
use P5indicatori\UserBundle\Form\Type\TrackingSourcesType;
use P5indicatori\UserBundle\Document\User;
use P5indicatori\UserBundle\Document\Source;
use Symfony\Component\HttpFoundation\JsonResponse;


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
//        $userSources = array();
        
//        if(empty($postedElements) && empty($tracking_type)){
//            return $this->redirect($this->generateUrl('p5indicatori_user_homepage'));
//        }elseif(!empty($tracking_type) && empty($postedElements)){
//            $postedElements['tracking_sources_types_form']['trackingTypes'] = $tracking_type;
//        }
        //getting the form name
//        $formName = key($postedElements);
//        $trackingTypeGet = strtolower($postedElements[$formName]['trackingTypes']);
//        $ownerSource = $this->container->get('security.context')->getToken()->getUser();
        //extracting from DB
//        $userSources = $this->get('doctrine_mongodb')
//                ->getManager()
//                ->getRepository('P5indicatoriUserBundle:Source')
//                ->getUserSourcesByType($ownerSource->getUsername(),$trackingTypeGet);
        $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container,$postedElements), new Source());

        $pageTitle = 'Sources, add source';
        return $this->render('P5indicatoriUserBundle:Sources:addUserSourceForm.html.twig', array(
                    'form' => $formSourcesTracking->createView()
        ));
    }
    
    /**
     * Add tracking sources to user.
     * @return type
     */
    public function addUserSourceAction() {
        $postedElements = $this->getRequest()->request->all();
        $response = array();
        if (!empty($postedElements)) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container, $postedElements), new Source());
            $formSourcesTracking->handleRequest($this->getRequest());

            if ($formSourcesTracking->isValid()) {
                $registration = $formSourcesTracking->getData();

                $dm->persist($registration);
                $dm->flush();

                //form from home page.
                $formTrackingTypes = $this->createForm(new TrackingType($this->container));
                $response['success'] = true;
                $returnHtml = $this->render('P5indicatoriUserBundle:Sources:homePageMainForm.html.twig', array(
                    'form' => $formTrackingTypes->createView(),
                ));
                $response['formHtml'] = $returnHtml->getContent();

                return new JsonResponse($response);
            }
        }
        $response['success'] = false;
        $returnHtml = $this->render('P5indicatoriUserBundle:Sources:addUserSourceForm.html.twig', array(
            'form' => $formSourcesTracking->createView(),
        ));
        $response['formHtml'] = $returnHtml->getContent();
        return new JsonResponse($response);
    }
   
}
