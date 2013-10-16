<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use P5indicatori\UserBundle\Document\User;
use P5indicatori\UserBundle\Document\Source;


class FormFilterController extends Controller {

    public function addFormsAction($id) {
        if (!empty($id)) {
            $userSource = $this->get('doctrine_mongodb')
                    ->getRepository('P5indicatoriUserBundle:Source')
                    ->find($id);
            if(count($userSource) > 0){
               $className = $userSource->getTrackingSourcesTypes();
               $className = str_replace(array(' ','.'), array('','Dot'), $className);                        
               $trackingType = ucfirst($userSource->getTrackingTypes());
               $classNameWithNamespace = '\\P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\\'.$trackingType.'\\'.$className;
               //getting from database
               $redmineKey = $userSource->getRedmineUserKey();
               $jiraLogin = $userSource->getJiraLogin();
               $jiraPassword = $userSource->getJiraPassword();
               $sourceUrl = $userSource->getUrlLink();
               
               //createing object dynamically 
               $trackerTypeObject = new $classNameWithNamespace($this->container);
               $trackerTypeObject->connect($redmineKey,$jiraLogin,$jiraPassword);
               $trackerTypeObject->setSourceUrl($sourceUrl);
               $data = $trackerTypeObject->extractDatesLogic($userSource->getId());

            }
        }
    }

}
