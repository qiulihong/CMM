<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('type_id')
            ->add('brand_id')
            ->add('url_or_location')
            ->add('look_id')
            ->add('position')
            ->add('looks')
            ->add('brand')
            ->add('clothType')
        ;
    }

    public function getName()
    {
        return 'choumei_looksbundle_tagtype';
    }
}
