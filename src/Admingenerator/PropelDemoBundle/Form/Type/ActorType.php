<?php

namespace Admingenerator\PropelDemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function getName()
    {
        return 'propel_embed_actor';
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Admingenerator\PropelDemoBundle\Model\Actor',
        );
    }
}
