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
 * Description of BaseFilterFormType
 *
 * @author mtamazlicaru
 */
class BaseFilterFormType extends AbstractType {
    private $formConfig = array();
    private $container;
    
    public function __construct(ContainerInterface $container, $formConfig = array()) {
        $this->container = $container;
        $this->formConfig = $formConfig;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

    }
    
    public function getName() {
        return 'base_filter_form';
    }    
}

?>
