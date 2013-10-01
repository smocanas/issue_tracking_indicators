<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TrackingVersionsType extends AbstractType{
    private $container;
    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('tracking_versions', 'choice', array(
            'choices' => $this->container->getParameter('versions.jira_redmine'),
            'required' => false,
            'expanded' => false,
            'multiple' => false,
            'empty_value' => 'Choose an tracking version',
        ));
    }
    
    public function getName() {
        return 'tracking_versions_form';
    }
}
?>
