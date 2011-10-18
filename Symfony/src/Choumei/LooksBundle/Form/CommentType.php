<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            //->add('created_at')
            ->add('comment_id', 'hidden')
            ->add('content', 'textarea', array('label'=>'说两句'))
            //->add('user', 'hidden')
            //->add('looks')
        ;
    }

    public function getName()
    {
        return 'choumei_looksbundle_commenttype';
    }
}
