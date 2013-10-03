<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TrackingType extends AbstractType{
    private $container;
    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $choices = $this->container->getParameter('tracking_types');
        $choices = array_combine($choices, $choices);
        
        $builder->add('tracking_types', 'choice', array(
            'choices' => $choices,
            'empty_value' => 'Choose tracking type',
            'attr' => array(
                'class' => 'control-group'
            ),
            'label' => ' '
        ));
    }
    
    public function getName() {
        return 'tracking_types_form';
    }
}
?>
