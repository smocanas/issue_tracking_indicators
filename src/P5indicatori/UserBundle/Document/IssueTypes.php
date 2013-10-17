<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * Description of IssueTypes
 *
 * @author mtamazlicaru
 */

/**
  * @MongoDB\EmbeddedDocument 
  */
class IssueTypes {
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @MongoDB\String
     */
    protected $issueTypeId;
    
    /**
     * @MongoDB\String
     */
    protected $name;
    
    /**
     * @MongoDB\String
     */
    protected $description;
    
    /**
     * @MongoDB\String
     */
    protected $icon;
    
    /**
     * @MongoDB\String
     */
    protected $subTask;

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
     * Set issueTypeId
     *
     * @param string $issueTypeId
     * @return self
     */
    public function setIssueTypeId($issueTypeId)
    {
        $this->issueTypeId = $issueTypeId;
        return $this;
    }

    /**
     * Get issueTypeId
     *
     * @return string $issueTypeId
     */
    public function getIssueTypeId()
    {
        return $this->issueTypeId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get icon
     *
     * @return string $icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set subTask
     *
     * @param string $subTask
     * @return self
     */
    public function setSubTask($subTask)
    {
        $this->subTask = $subTask;
        return $this;
    }

    /**
     * Get subTask
     *
     * @return string $subTask
     */
    public function getSubTask()
    {
        return $this->subTask;
    }
}
