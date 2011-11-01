<?php

namespace Choumei\LooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType
{
  const TOP = 1;
  const BOTTOM = 2;
  const FOOT  = 3;
  const ACCESSORY = 4;
  
    public function buildForm(FormBuilder $builder, array $options)
    {
      $types  = array(
        self::TOP => '上衣',
        self::BOTTOM => '下身',
        self::FOOT => '脚穿',
        self::ACCESSORY => '配饰',
      );
        $builder
            //->add('cloth_type_category','choice', array( 'choices'=>$types, 'label'=>'名称'))
            ->add('cloth_type',null, array('label'=>'名称'))
            ->add('brand', null, array('label'=>'品牌'))
            ->add('url_or_location', 'text', array('required'=>false, 'label'=>'地址或网址'))
            ->add('position', 'hidden')
            //->add('looks')
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
