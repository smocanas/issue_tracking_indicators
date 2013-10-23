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
    //rest documentation Jira 4.4 https://developer.atlassian.com/static/rest/jira/4.4.1.html
    protected $jiraLogin;
    protected $jiraPassword;
    protected $userKey;
    protected $urlTermination;
    private $baseVersionUrl = '/rest/api/2.0.alpha1/';
    
    //setting soap for taking Isues Types per project.
    protected $soapToken;
    protected $soapServiceUrl = '/rpc/soap/jirasoapservice-v2?wsdl';

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
        $this->urlTermination = 'project/'.$pkey.'/components';
        return $this->getHttpResponseBasedOnUrl();
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
        $data = array();
        if (count($userProjects) > 0) {
            foreach ($userProjects as $key => $project) {
                $tmpProjectUsers = $this->getProjectUsers($project['key']);
                if (!empty($tmpProjectUsers)) {
                    $projectFullRepresentation = $this->getProjectFullRepresentation($project['key']);
                    $data['projectName'][] = $project;
                    $data['actors'][] = $tmpProjectUsers;
                    $data['components'][] = $projectFullRepresentation['components'];
                }
            }
        }
        return $data;
    }

    public function saveDataProjects($sourceId, $data = array()) {
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $sourceName = $dm->find('\\P5indicatori\UserBundle\Document\Source', $sourceId);
        $arrayOfCollections = $this->transformArrayToArrayOfObjects($data);
        $sourceName->addProjectName($arrayOfCollections);
        $dm->persist($sourceName);
        $dm->flush();
    }

    public function transformArrayToArrayOfObjects($data){
        $projectArray = $data['projectName'];
        $actorsArray = $data['actors'];
        $componentsArray = $data['components'];
        
        $arrayCollection = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($projectArray as $key => $value) {
            $project = new ProjectName();
            $project->setKey($value['key']);
            $project->setName($value['name']);
            $project->setRoles($value['roles']);
            $project->setSelf($value['self']);    
            $project->addActor($this->saveActorsToProject($actorsArray[$key]['actors']));
            $project->addComponent($this->saveComponentToProject($componentsArray[$key]));
            $arrayCollection[] = $project;
        }
        
        return $arrayCollection;
    }
    
    public function saveActorsToProject($actors) {
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $arrayCollection = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($actors as $key => $value) {
            $actor = $dm->getRepository('\\P5indicatori\UserBundle\Document\Actors')->findOneBy(array('name' => $value['name']));
            if (empty($actor)) {
                $actor = new Actors();
            }
            if (!empty($value['id'])) {
                $actor->setActorId($value['id']);
            }
            $actor->setDisplayName($value['displayName']);
            $actor->setName($value['name']);
            $actor->setType($value['type']);
            $dm->persist($actor);
            $dm->flush($actor);
            $arrayCollection[] = $actor;
        }
        return $arrayCollection;
    }
    
    public function saveComponentToProject($component = array()){
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $arrayCollection = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($component as $key => $value) {
            $component = new \P5indicatori\UserBundle\Document\Components();
            $component->setComponentId($value['id']);
            $component->setName($value['name']);
            if (isset($value['description'])) {
                $component->setDescription($value['description']);
            }
            $component->setSelf($value['self']);
            $dm->persist($component);
            $arrayCollection[] = $component;
        }
        return $arrayCollection;
    }
    
    public function getProjectFullRepresentation($pkey) {
        //
        $this->urlTermination = 'project/'.$pkey;
        return $this->getHttpResponseBasedOnUrl();
    }
    
    public function prepareArrayToBuildFormChoices($source) {
        $projects = $source->getProjectName();
        $selectNameAndChoices;
        foreach ($array as $key => $value) {
            
        }
    }

}

