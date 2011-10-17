<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LooksType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('url', 'hidden', array('required'=>true))
            //->add('user_id')
            ->add('accessories', 'collection', array('type'=>new AccessoryType(), 'allow_add'=>true))
            ->add('tags', 'collection', array('type'=>new TagType(), 'allow_add'=>true ))
            //->add('styles')
            ->add('user')
        ;
    }

    public function getName()
    {
        return 'choumei_looksbundle_lookstype';
    }
    
    public function getDefaultOptions(array $options)
    {
      return array(
        'data_class'	=> 'Choumei\LooksBundle\Entity\Looks',
      );
    }
}
