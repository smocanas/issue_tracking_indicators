<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Jira;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigsAbstract;
/**
 *
 * @author mtamazlicaru
 */
class Jira extends P5BaseConfigsAbstract{
    protected $jiraLogin;
    protected $jiraPassword;
    
    
    public function setJiraUserLogin($jiraLogin){
        $this->jiraLogin;
    }
    
    public function setJiraUserPassword($jiraPassword){
        $this->jiraPassword;
    }

    public function getProjectVersions($pkey) {
        //
    }

    public function getUserProjects() {
        //
    }
    
    public function getProjectComponents($pkey){
        //
    }

    public function cacheData() {
        
    }

    public function getProjectUsers($pkey) {
        
    }
}

?>
