<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Redmine;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigs;
/**
 *
 * @author mtamazlicaru
 */
class Redmine extends P5BaseConfigs{
      protected $redmineKey;
    
      public function setRedmineUserKey($redmineKey){
          $this->redmineKey = $redmineKey;
      }
}

?>
