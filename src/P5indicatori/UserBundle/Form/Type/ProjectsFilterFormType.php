<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Form\Type;

/**
 * Description of ProjectsFilterFormType
 *
 * @author mtamazlicaru
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProjectsFilterFormType extends AbstractType {

    private $formConfig = array();

    public function __construct($formConfig = array()) {
        $this->formConfig = $formConfig;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $source = $this->formConfig['userSource'];
        
        $projectNames = $this->getProjectsForSource($source);
        $builder->add('projectName', 'choice', array(
                    'choices' => $projectNames,
                    'empty_value' => 'Choose an project',
        ));
        $builder->add('sourceId', 'hidden', array(
            'data' => $source->getId(),
        ));
    }

    public function getName() {
        return 'project_filter_form';
    }
    
    public function getProjectsForSource($source) {
        $trackerTypeObject = $this->formConfig['trackerTypeObject'];
        $formProjectsChoice = $trackerTypeObject->getSourceProjects($source);
        return $formProjectsChoice;
    }

}

