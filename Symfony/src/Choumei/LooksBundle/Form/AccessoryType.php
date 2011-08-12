<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AccessoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            //->add('looks_id', null, array('required'=>false))
            //->add('looks', new Looks())
            ->add('url', null, array('required'=>false))
        ;
    }

    public function getName()
    {
        return 'choumei_looksbundle_accessorytype';
    }
    
    public function getDefaultOptions(array $options)
    {
      return array(
        'data_class'	=> 'Choumei\LooksBundle\Entity\Accessory',
      );
    }
}
