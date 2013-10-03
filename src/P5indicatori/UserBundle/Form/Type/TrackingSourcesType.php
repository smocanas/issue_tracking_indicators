<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mtamazlicaru
 */
namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TrackingSourcesType extends AbstractType{
    private $container;
    private $postedElements;
    
    public function __construct(ContainerInterface $container, array $postedElements = array()) {
        $this->container = $container;
        $this->postedElements = $postedElements;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $choices = $this->checkSourceType();

        if (!empty($choices)) {
            $choicesAssoc = array_combine($choices['choices'], $choices['choices']);
            $selectedSourceType = $choices['selectedSourceType'];
        }
        //Name field
        $builder->add('source_name','text',array(
            'attr' => array(
              'class' => 'control-group'  
            ),
            'label'=> 'Name'
        ));
        //select
        $builder->add('tracking_sources_types', 'choice', array(
            'choices' => $choicesAssoc,
            'empty_value' => 'Choose tracking version',
            'attr' => array(
                'class' => 'control-group'
            )
        ));
        // url
        $builder->add('url_name', 'text', array(
            'attr' => array(
                'class' => 'control-group'
            ),
            'label' => 'URL'
        ));
        //selectet source
        switch ($selectedSourceType) {
            case 'redmine': {
                    $builder->add('user_key', 'text', array(
                        'attr' => array(
                            'class' => 'control-group'
                          ),
                        'label' => 'Redmine User Key'
                        )
                     );
                    break;
                };
            case 'jira': {
                    $builder->add('login', 'text', array(
                        'attr' => array(
                            'class' => 'control-group'
                        ),
                        'label' => 'Jira Login'
                    ));
                    $builder->add('psw', 'password', array(
                        'attr' => array(
                            'class' => 'control-group'
                            ),
                        'label' => 'Jira Password'
                        ));
                    break;
                };
        }
    }
    
    public function getName() {
        return 'tracking_sources_types_form';
    }
    
    /**
     * Check if tracking source was selected and exist.
     * @return array
     */
    public function checkSourceType(){
        $postedElements = $this->postedElements;
        
        $selectedSourceType = strtolower($postedElements['tracking_types_form']['tracking_types']);
        $choices = array();
        if(isset($selectedSourceType) && !empty($selectedSourceType)){
            $choices = $this->container->getParameter('versions.'.$selectedSourceType);
        }
        
        return array(
            'choices' => $choices,
            'selectedSourceType' => $selectedSourceType
                );
    }
}
?>
