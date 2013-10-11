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
    protected $source_name;

    /**
     * @MongoDB\String
     */
    protected $tracking_sources_types;

    /**
     * @MongoDB\String
     */
    protected $url_link;

    /**
     * @MongoDB\String
     */
    protected $redmine_user_key;
  
    /**
     * @MongoDB\String
     */
    protected $jira_login;
    
    /**
     * @MongoDB\String
     */
    protected $jira_password;
    
    /**
     * @MongoDB\String
     */
    protected $tracking_types;
    
    /**
     * @MongoDB\String
     */
    protected $ownerSource;
   
    /**
     * @MongoDB\EmbedMany(targetDocument="P5indicatori\UserBundle\Document\ProjectName")
     * 
     */
    protected $project_name = array();
    
    public function __construct()
    {
        $this->project_name = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->source_name = $sourceName;
        return $this;
    }

    /**
     * Get sourceName
     *
     * @return string $sourceName
     */
    public function getSourceName()
    {
        return $this->source_name;
    }

    /**
     * Set trackingSourcesTypes
     *
     * @param string $trackingSourcesTypes
     * @return self
     */
    public function setTrackingSourcesTypes($trackingSourcesTypes)
    {
        $this->tracking_sources_types = $trackingSourcesTypes;
        return $this;
    }

    /**
     * Get trackingSourcesTypes
     *
     * @return string $trackingSourcesTypes
     */
    public function getTrackingSourcesTypes()
    {
        return $this->tracking_sources_types;
    }

    /**
     * Set urlLink
     *
     * @param string $urlLink
     * @return self
     */
    public function setUrlLink($urlLink)
    {
        $this->url_link = $urlLink;
        return $this;
    }

    /**
     * Get urlLink
     *
     * @return string $urlLink
     */
    public function getUrlLink()
    {
        return $this->url_link;
    }

    /**
     * Set redmineUserKey
     *
     * @param string $redmineUserKey
     * @return self
     */
    public function setRedmineUserKey($redmineUserKey)
    {
        $this->redmine_user_key = $redmineUserKey;
        return $this;
    }

    /**
     * Get redmineUserKey
     *
     * @return string $redmineUserKey
     */
    public function getRedmineUserKey()
    {
        return $this->redmine_user_key;
    }

    /**
     * Set jiraLogin
     *
     * @param string $jiraLogin
     * @return self
     */
    public function setJiraLogin($jiraLogin)
    {
        $this->jira_login = $jiraLogin;
        return $this;
    }

    /**
     * Get jiraLogin
     *
     * @return string $jiraLogin
     */
    public function getJiraLogin()
    {
        return $this->jira_login;
    }

    /**
     * Set jiraPassword
     *
     * @param string $jiraPassword
     * @return self
     */
    public function setJiraPassword($jiraPassword)
    {
        $this->jira_password = $jiraPassword;
        return $this;
    }

    /**
     * Get jiraPassword
     *
     * @return string $jiraPassword
     */
    public function getJiraPassword()
    {
        return $this->jira_password;
    }

    /**
     * Set trackingTypes
     *
     * @param string $trackingTypes
     * @return self
     */
    public function setTrackingTypes($trackingTypes)
    {
        $this->tracking_types = $trackingTypes;
        return $this;
    }

    /**
     * Get trackingTypes
     *
     * @return string $trackingTypes
     */
    public function getTrackingTypes()
    {
        return $this->tracking_types;
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
        $this->project_name[] = $projectName;
    }

    /**
     * Remove projectName
     *
     * @param P5indicatori\UserBundle\Document\ProjectName $projectName
     */
    public function removeProjectName(\P5indicatori\UserBundle\Document\ProjectName $projectName)
    {
        $this->project_name->removeElement($projectName);
    }

    /**
     * Get projectName
     *
     * @return Doctrine\Common\Collections\Collection $projectName
     */
    public function getProjectName()
    {
        return $this->project_name;
    }
}
