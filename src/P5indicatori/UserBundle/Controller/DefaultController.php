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
        $response = array(
            'exception' => null,
            'success' => null,
            'form' => null
        );
        if (!empty($postedElements)) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $sourceSave = new Source();
            $formSourcesTracking = $this->createForm(new TrackingSourcesType($this->container, $postedElements), $sourceSave);
            $formSourcesTracking->handleRequest($this->getRequest());

            if ($formSourcesTracking->isValid()) {
                $registration = $formSourcesTracking->getData();

                $dm->persist($registration);
                $dm->flush();

                //form from home page.
                $formTrackingTypes = $this->createForm(new TrackingType($this->container));

                $sourceId = $sourceSave->getId();
                $dataSaved = $this->saveDataFromRestApi($sourceId);
                //inline if statement
                if (empty($dataSaved)) {
                    $response['success'] = false;
                    $response['exception'] = "Authentication failed or wrong saved url source, please change source details.";
                    //return form
                    $returnHtml = $this->render('P5indicatoriUserBundle:Sources:addUserSourceForm.html.twig', array(
                        'form' => $formSourcesTracking->createView(),
                    ));
                    $response['formHtml'] = $returnHtml->getContent();
                    
                    $dm->remove($registration);
                    $dm->flush();
                    return new JsonResponse($response);
                } else {
                    $response['success'] = true;
                }

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
    
    public function saveDataFromRestApi($sourceId) {
        $userSource = $this->get('doctrine_mongodb')
                ->getRepository('P5indicatoriUserBundle:Source')
                ->find($sourceId);
        if (count($userSource) > 0) {
            $trackerTypeObject = $this->createDynamicObjectBySourceType($userSource);
            $data = $trackerTypeObject->extractDatesLogic($userSource->getId());
            if (!empty($data)) {
                $trackerTypeObject->saveDataProjects($userSource->getId(), $data);
            }
            return $data;
        }
    }
    
    public function userSourcesAction() {
        $ownerSource = $this->container->get('security.context')->getToken()->getUser();
        $userSources = $this->get('doctrine_mongodb')
                ->getManager()
                ->getRepository('P5indicatoriUserBundle:Source')
                ->findByOwnerSource($ownerSource->getUsername());

        return $this->render('P5indicatoriUserBundle:Sources:userSources.html.twig', array(
                    'userSources' => $userSources,
        ));
    }
    
    /**
     * Return intialized object by source type. 
     * Ex: (object class name: Jira4Dot4, Redmine1Dot3 etc.)
     * @param object $source
     * @return \P5indicatori\UserBundle\Controller\classNameWithNamespace
     */
    public function createDynamicObjectBySourceType($userSource = object) {
        $className = $userSource->getTrackingSourcesTypes();
        $className = str_replace(array(' ', '.'), array('', 'Dot'), $className);
        $trackingType = ucfirst($userSource->getTrackingTypes());
        $classNameWithNamespace = '\\P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\\' . $trackingType . '\\' . $className;
        //getting from database
        $redmineKey = $userSource->getRedmineUserKey();
        $jiraLogin = $userSource->getJiraLogin();
        $jiraPassword = $userSource->getJiraPassword();
        $sourceUrl = $userSource->getUrlLink();

        //createing object dynamically
        $trackerTypeObject = new $classNameWithNamespace($this->container);
        $trackerTypeObject->connect($redmineKey, $jiraLogin, $jiraPassword);
        $trackerTypeObject->setSourceUrl($sourceUrl);

        return $trackerTypeObject;
    }
   
}
