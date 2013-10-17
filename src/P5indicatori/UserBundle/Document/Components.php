<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * Description of Components
 *
 * @author mtamazlicaru
 */

/**
 * @MongoDB\EmbeddedDocument 
 */
class Components {
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    
   /**
     * @MongoDB\String
     */
    protected $componentId;
    
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
    protected $self;

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
     * Set componentId
     *
     * @param string $componentId
     * @return self
     */
    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
        return $this;
    }

    /**
     * Get componentId
     *
     * @return string $componentId
     */
    public function getComponentId()
    {
        return $this->componentId;
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
     * Set self
     *
     * @param string $self
     * @return self
     */
    public function setSelf($self)
    {
        $this->self = $self;
        return $this;
    }

    /**
     * Get self
     *
     * @return string $self
     */
    public function getSelf()
    {
        return $this->self;
    }
}
