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
    
      public function setRedmineUserKey($redmineKey){
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
}

?>
