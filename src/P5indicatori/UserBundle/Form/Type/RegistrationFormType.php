<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('email', 'email', array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Email...',
                        'class' => 'control-group input-medium'
                    ), 
                    'translation_domain' => 'FOSUserBundle'))
            ->add('username', 'text', array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Username...',
                        'class' => 'control-group input-medium'
                    ),
                    'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Password...',
                        'class' => 'control-group input-medium'
                     )
                    ),
                'second_options' => array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Confirm password...',
                        'class' => 'control-group input-medium'
                     )
                    ),
                'invalid_message' => 'The password fields must match.',
            ));
    }

    public function getName() {
        return 'p5indicatori_user_registration';
    }

}
?>
