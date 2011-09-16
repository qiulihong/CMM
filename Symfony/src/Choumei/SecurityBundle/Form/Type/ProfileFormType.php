<?php
namespace Choumei\SecurityBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileType;
use Symfony\Component\Form\FormBuilder;

class ProfileFormType extends BaseProfileType
{
  
  public function buildUserForm(FormBuilder $builder, array $options)
  {
    parent::buildUserForm($builder, $options);
    $builder->add('nickname')
            ->add('dob', 'date', array('widget'=>'single_text'));
  }
  
  public function getName()
  {
    return 'choumei_user_profile';
  }
}