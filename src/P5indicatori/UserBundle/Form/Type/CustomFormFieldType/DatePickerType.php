<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace P5indicatori\UserBundle\Form\Type\CustomFormFieldType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of DateType
 *
 * @author mtamazlicaru
 */
class DatePickerType extends AbstractType {

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'input' => 'datetime',
            'widget' => 'single_text'
        ));
    }

    public function getParent() {
        return 'date';
    }

    public function getName() {
        return 'datePicker';
    }

}
