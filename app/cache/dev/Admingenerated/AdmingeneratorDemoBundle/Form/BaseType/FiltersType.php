<?php

namespace Admingenerated\AdmingeneratorDemoBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FiltersType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
         $builder
            ->add('title', 'text', array(  'required' => false,))
            ->add('is_published', 'choice', array(  'required' => false,  'choice_list' =>    new \Symfony\Component\Form\Extension\Core\ChoiceList\ArrayChoiceList(array(  0 => 'No',  1 => 'Yes',)),  'empty_value' => 'Yes or No',));
    }

    public function getName()
    {
        return 'filters_movie';
    }
}
