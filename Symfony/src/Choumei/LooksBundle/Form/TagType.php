<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('clothType')
            ->add('brand')
            ->add('url_or_location')
            ->add('look_id')
            ->add('position')
            ->add('looks')
        ;
    }

    public function getName()
    {
        return 'choumei_looksbundle_tagtype';
    }
    
    public function getDefaultOptions(array $options)
    {
      return array(
        'data_class'	=> 'Choumei\LooksBundle\Entity\Tag',
      );
    }
}
