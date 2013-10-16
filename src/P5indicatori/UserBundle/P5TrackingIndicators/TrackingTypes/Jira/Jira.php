<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Jira;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigsAbstract;
use P5indicatori\UserBundle\Document\Source;
use P5indicatori\UserBundle\Document\ProjectName;
use P5indicatori\UserBundle\Document\Actors;
use Doctrine\ODM\MongoDB\LoggableCursor;
/**
 *
 * @author mtamazlicaru
 */
class Jira extends P5BaseConfigsAbstract {

    protected $jiraLogin;
    protected $jiraPassword;
    protected $userKey;
    protected $urlTermination;
    private $baseVersionUrl = '/rest/api/2.0.alpha1/';

    protected function setJiraUserLogin($jiraLogin) {
        $this->jiraLogin = $jiraLogin;
    }

    protected function setJiraUserPassword($jiraPassword) {
        $this->jiraPassword = $jiraPassword;
    }

    /**
     * Get http response based on url that return an associative array created
     * from JSON format.
     * @return associative array
     */
    protected function getHttpResponseBasedOnUrl($useBase = true, $url = null) {
        //Jira4Dot4 Default
        if ($useBase) {
            $url = rtrim($this->sourceUrl, '/') . $this->baseVersionUrl . $this->urlTermination;
        }
        $parameters = array("Authorization: Basic " . $this->userKey);
        //getting service for issuing HTTP requests  
        $buzz = $this->container->get('buzz');
        $response = $buzz->get($url, $parameters);
        $contentJsonFormat = $response->getContent();

        return json_decode($contentJsonFormat, true);
    }

    public function getProjectVersions($pkey) {
        //
    }

    public function getUserProjects() {
        $this->urlTermination = 'project/';
        return $this->getHttpResponseBasedOnUrl();
    }

    public function getProjectComponents($pkey) {
        //
    }

    public function cacheData() {
        
    }

    public function getProjectUsers($pkey) {
        $this->urlTermination = 'project/' . $pkey;
        $projectUsers = $this->getHttpResponseBasedOnUrl();
        if ($projectUsers['lead']['name'] == $this->jiraLogin) {
            $url = $projectUsers['roles']['Developers'];
            return $this->getHttpResponseBasedOnUrl(false, $url);
        }
        return array();
    }

    /**
     * set user key
     * @param type $key string
     */
    public function setUserKey($key) {
        $this->userKey = $key;
    }

    /**
     * calculate user key from user login and user password 
     */
    public function calcUserKey() {
        $key = base64_encode($this->jiraLogin . ':' . $this->jiraPassword);
        $this->setUserKey($key);
    }

    public function connect($redmineKey = null, $jiraLogin = null, $jiraPassword = null) {
        $this->setJiraUserLogin($jiraLogin);
        $this->setJiraUserPassword($jiraPassword);
        $this->calcUserKey();
    }

    public function extractDatesLogic($sourceId) {
        $userProjects = $this->getUserProjects();
        $projectUsers = array();

        if (count($userProjects) > 0) {
            foreach ($userProjects as $key => $project) {
                $tmpProjectUsers = $this->getProjectUsers($project['key']);
                if (!empty($tmpProjectUsers)) {
                    $data['userProject'][] = $project;
                    $data['projectUsers'][] = $tmpProjectUsers;
                }
            }
//             $this->saveDataProjects($sourceId, $data);
        }
        return $data;
    }

    public function saveDataProjects($sourceId, $data = array()) {
//        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
//        $sourceName = $dm->find('\\P5indicatori\UserBundle\Document\Source', $sourceId);
//
//        foreach ($data as $pKey => $value) {
//            $projectName[$pKey] = $dm->getRepository('\\P5indicatori\UserBundle\Document\Source')
//                                     ->getProjectDetailsByName($sourceId,$value['userProject']['key']);
//
//            if (empty($projectName[$pKey])) {
//                $projectName[$pKey] = new ProjectName();
//                //setting Project
////                die;
//                $projectName[$pKey]->setKey($value['userProject']['key']);
//                $projectName[$pKey]->setName($value['userProject']['name']);
//                $projectName[$pKey]->setRoles($value['userProject']['roles']);
//                $projectName[$pKey]->setSelf($value['userProject']['self']);
//            } else {
//                $projectName[$pKey] = $projectName[$pKey]->getProjectName()->getValues();
//                $projectName[$pKey] = $projectName[$pKey][0];
//                
//            }
//            //setting actors
//            $this->saveDataActors($projectName[$pKey], $value['projectUsers']['actors']);
//            $sourceName->addProjectName($projectName[$pKey]);
//        } 
//        $dm->flush();
    }

    public function saveDataActors($projectName, $data = array(), $sourceId = null) {
//        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
//        foreach ($data as $key => $actor) {
//            $isNewActor = false;
//            $actors[$key] = $dm->getRepository('\\P5indicatori\UserBundle\Document\Actors')->findOneBy(array('name' => $actor['name']));
//            if (empty($actors[$key])) {
//                $actors[$key] = new Actors();
//                $isNewActor = true;
//            }
//            if (!empty($actor['id'])) {
//                $actors[$key]->setActorId($actor['id']);
//            }
//            $actors[$key]->setDisplayName($actor['displayName']);
//            $actors[$key]->setName($actor['name']);
//            $actors[$key]->setType($actor['type']);
//
//            $dm->persist($actors[$key]);
//            $dm->flush($actors[$key]);
//            if ($isNewActor) {
//                $projectName->addActor($actors[$key]);
//            }
//        }
    }

}

