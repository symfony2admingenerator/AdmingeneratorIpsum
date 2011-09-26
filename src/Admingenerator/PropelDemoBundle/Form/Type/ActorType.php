<?php

namespace Admingenerator\PropelDemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ActorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
    }
    
    public function getName()
    {
        return 'propel_embed_actor';
    }
}