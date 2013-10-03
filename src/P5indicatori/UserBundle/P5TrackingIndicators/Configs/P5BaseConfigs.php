<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\P5TrackingIndicators\Configs;

use P5indicatori\UserBundle\P5TrackingIndicators\P5TrackingIndicators as P5Indicators;
/**
 *
 * @author mtamazlicaru
 */
class P5BaseConfigs extends P5Indicators{
    protected $sourceUrl;
    protected $sourceName;
    protected $trackingType;


    public function setSourceUrl($sourceUrl){
        $this->sourceUrl = $sourceUrl;
    }
    
    public function setSourceName($sourceName){
        $this->sourceName = $sourceName;
    }
    
    public function setTrackingType($trackingType){
        $this->trackingType = $trackingType;
    }
    
    
}

?>
