<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\Configs;


/**
 *
 * @author mtamazlicaru
 */
abstract class P5BaseConfigsAbstract { 
    protected $sourceUrl;
    protected $sourceName;
    protected $trackingType;
    protected $container;
    
    public function __construct($container = null) {
        $this->setContainer($container);
    }

    public function setSourceUrl($sourceUrl){
        $this->sourceUrl = $sourceUrl;
    }
    
    public function setSourceName($sourceName){
        $this->sourceName = $sourceName;
    }
    
    public function setTrackingType($trackingType){
        $this->trackingType = $trackingType;
    }
    
    public function setContainer($container){
        $this->container = $container;
    }
    
    abstract public function connect($redmineKey = null, $jiraLogin = null, $jiraPassword = null);
    
    abstract public function extractDatesLogic($sourceId);
    
    abstract public function getUserProjects();
    
    abstract public function getProjectVersions($pkey);
    
    abstract public function getProjectUsers($pkey);
    
    abstract public function cacheData();
    
    abstract public function saveData($data = array(),$sourceId);
}


