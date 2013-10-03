<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\TrackingTypes\Jira;

use P5indicatori\UserBundle\P5TrackingIndicators\Configs\P5BaseConfigs;
/**
 *
 * @author mtamazlicaru
 */
class Jira extends P5BaseConfigs{
    protected $jiraLogin;
    protected $jiraPassword;


    public function setJiraUserLogin($jiraLogin){
        $this->jiraLogin;
    }
    
    public function setJiraUserPassword($jiraPassword){
        $this->jiraPassword;
    }
}

?>
