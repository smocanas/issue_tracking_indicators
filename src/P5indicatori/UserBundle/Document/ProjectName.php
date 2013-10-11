<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * Description of ProjectName
 *
 * @author mtamazlicaru
 */

/**
 * @MongoDB\EmbeddedDocument 
 */
class ProjectName {   
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
   /**
     * @MongoDB\String
     */
    protected $key;

    /**
     * @MongoDB\String
     */
    protected $name;
    
    /**
     * \@MongoDB\EmbedOne
     */
    protected $roles = array();
    
    /**
     * @MongoDB\String
     */
    protected $self;

    /** 
     * @MongoDB\ReferenceMany(targetDocument="P5indicatori\UserBundle\Document\Actors")
     */
    protected $actors = array();
    
    public function __construct()
    {
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set key
     *
     * @param string $key
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get key
     *
     * @return string $key
     */
    public function getKey()
    {
        return $this->key;
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

    /**
     * Add actor
     *
     * @param P5indicatori\UserBundle\Document\Actors $actor
     */
    public function addActor(\P5indicatori\UserBundle\Document\Actors $actor)
    {
        $this->actors[] = $actor;
    }

    /**
     * Remove actor
     *
     * @param P5indicatori\UserBundle\Document\Actors $actor
     */
    public function removeActor(\P5indicatori\UserBundle\Document\Actors $actor)
    {
        $this->actors->removeElement($actor);
    }

    /**
     * Get actors
     *
     * @return Doctrine\Common\Collections\Collection $actors
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Set roles
     *
     * @param $roles
     * @return self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Get roles
     *
     * @return $roles
     */
    public function getRoles()
    {
        return $this->roles;
    }
}