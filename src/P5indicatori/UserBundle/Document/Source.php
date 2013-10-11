<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Description of Source
 *
 * @author mtamazlicaru
 */
/**
 * @MongoDB\Document(repositoryClass="P5indicatori\UserBundle\Repository\SourceRepository")
 */
class Source {

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $sourceName;

    /**
     * @MongoDB\String
     */
    protected $trackingSourcesTypes;

    /**
     * @MongoDB\String
     */
    protected $urlLink;

    /**
     * @MongoDB\String
     */
    protected $redmineUserKey;
  
    /**
     * @MongoDB\String
     */
    protected $jiraLogin;
    
    /**
     * @MongoDB\String
     */
    protected $jiraPassword;
    
    /**
     * @MongoDB\String
     */
    protected $trackingTypes;
    
    /**
     * @MongoDB\String
     */
    protected $ownerSource;
   
    /**
     * @MongoDB\EmbedMany(targetDocument="P5indicatori\UserBundle\Document\ProjectName")
     * 
     */
    protected $projectName = array();

    public function __construct()
    {
        $this->projectName = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sourceName
     *
     * @param string $sourceName
     * @return self
     */
    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;
        return $this;
    }

    /**
     * Get sourceName
     *
     * @return string $sourceName
     */
    public function getSourceName()
    {
        return $this->sourceName;
    }

    /**
     * Set trackingSourcesTypes
     *
     * @param string $trackingSourcesTypes
     * @return self
     */
    public function setTrackingSourcesTypes($trackingSourcesTypes)
    {
        $this->trackingSourcesTypes = $trackingSourcesTypes;
        return $this;
    }

    /**
     * Get trackingSourcesTypes
     *
     * @return string $trackingSourcesTypes
     */
    public function getTrackingSourcesTypes()
    {
        return $this->trackingSourcesTypes;
    }

    /**
     * Set urlLink
     *
     * @param string $urlLink
     * @return self
     */
    public function setUrlLink($urlLink)
    {
        $this->urlLink = $urlLink;
        return $this;
    }

    /**
     * Get urlLink
     *
     * @return string $urlLink
     */
    public function getUrlLink()
    {
        return $this->urlLink;
    }

    /**
     * Set redmineUserKey
     *
     * @param string $redmineUserKey
     * @return self
     */
    public function setRedmineUserKey($redmineUserKey)
    {
        $this->redmineUserKey = $redmineUserKey;
        return $this;
    }

    /**
     * Get redmineUserKey
     *
     * @return string $redmineUserKey
     */
    public function getRedmineUserKey()
    {
        return $this->redmineUserKey;
    }

    /**
     * Set jiraLogin
     *
     * @param string $jiraLogin
     * @return self
     */
    public function setJiraLogin($jiraLogin)
    {
        $this->jiraLogin = $jiraLogin;
        return $this;
    }

    /**
     * Get jiraLogin
     *
     * @return string $jiraLogin
     */
    public function getJiraLogin()
    {
        return $this->jiraLogin;
    }

    /**
     * Set jiraPassword
     *
     * @param string $jiraPassword
     * @return self
     */
    public function setJiraPassword($jiraPassword)
    {
        $this->jiraPassword = $jiraPassword;
        return $this;
    }

    /**
     * Get jiraPassword
     *
     * @return string $jiraPassword
     */
    public function getJiraPassword()
    {
        return $this->jiraPassword;
    }

    /**
     * Set trackingTypes
     *
     * @param string $trackingTypes
     * @return self
     */
    public function setTrackingTypes($trackingTypes)
    {
        $this->trackingTypes = $trackingTypes;
        return $this;
    }

    /**
     * Get trackingTypes
     *
     * @return string $trackingTypes
     */
    public function getTrackingTypes()
    {
        return $this->trackingTypes;
    }

    /**
     * Set ownerSource
     *
     * @param string $ownerSource
     * @return self
     */
    public function setOwnerSource($ownerSource)
    {
        $this->ownerSource = $ownerSource;
        return $this;
    }

    /**
     * Get ownerSource
     *
     * @return string $ownerSource
     */
    public function getOwnerSource()
    {
        return $this->ownerSource;
    }

    /**
     * Add projectName
     *
     * @param P5indicatori\UserBundle\Document\ProjectName $projectName
     */
    public function addProjectName(\P5indicatori\UserBundle\Document\ProjectName $projectName)
    {
        $this->projectName[] = $projectName;
    }

    /**
     * Remove projectName
     *
     * @param P5indicatori\UserBundle\Document\ProjectName $projectName
     */
    public function removeProjectName(\P5indicatori\UserBundle\Document\ProjectName $projectName)
    {
        $this->projectName->removeElement($projectName);
    }

    /**
     * Get projectName
     *
     * @return Doctrine\Common\Collections\Collection $projectName
     */
    public function getProjectName()
    {
        return $this->projectName;
    }
}
