<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Description of Project
 *
 * @author mtamazlicaru
 */
class Project {

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $tracking_types;

    /**
     * @MongoDB\String
     */
    protected $password;

    /**
     * @MongoDB\String
     */
    protected $email;

}

?>
