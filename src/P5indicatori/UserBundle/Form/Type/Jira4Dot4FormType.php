<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Jira4Dot4FormType
 *
 * @author mtamazlicaru
 */
class Jira4Dot4FormType extends AbstractType{
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

    }

    public function getName() {
        return 'jira4Dot4_filter_form';
    }

}


