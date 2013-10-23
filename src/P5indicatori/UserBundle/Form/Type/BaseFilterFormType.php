<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use P5indicatori\UserBundle\Document\ProjectName;
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
        $source = $this->formConfig['userSource'];

        $arrayFormOptions = $this->getArrayBySource($source); 
        foreach ($arrayFormOptions as $key => $value) {
            $builder
                    ->add($key, 'choice', array(
                        'choices' => $value,
                        'multiple' => true
                    ));           
        }
        
    }
    
    public function getName() {
        return 'base_filter_form';
    } 
    
    public function getArrayBySource($source){
        $trackerTypeObject = $this->formConfig['trackerTypeObject'];
        $formArraysForChoice = $trackerTypeObject->prepareArrayToBuildFormChoices($source,$this->formConfig);
        return $formArraysForChoice;
    }
}

?>
