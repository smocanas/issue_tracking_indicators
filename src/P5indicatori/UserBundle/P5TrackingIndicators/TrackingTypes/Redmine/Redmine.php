<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Redmine;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigsAbstract;
/**
 *
 * @author mtamazlicaru
 */
class Redmine extends P5BaseConfigsAbstract{
      protected $redmineKey;
    
      protected function setRedmineUserKey($redmineKey){
          $this->redmineKey = $redmineKey;
      }

    public function getProjectVersions() {
        //
    }

    public function getUserProjects($pkey) {
        //
    }

    public function cacheData() {
        
    }

    public function getProjectUsers($pkey) {
        
    }
    
    public function connect($redmineKey = null, $jiraLogin = null, $jiraPassword = null) {
        $this->setRedmineUserKey($redmineKey);
    }

    public function extractDatesLogic($sourceId) {
        
    }

    public function saveData($data = array(),$sourceId) {
        
    }
}


