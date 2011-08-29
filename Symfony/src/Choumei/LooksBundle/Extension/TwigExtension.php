<?php
// LooksBundle/Extension/TwigExtension.php
namespace Choumei\LooksBundle\Extension;

class TwigExtension extends \Twig_Extension
{
  public function getFilters()
  {
    return array(
      'fetchX'	=> new \Twig_Filter_Method($this, 'fetchX'),
      'fetchY'	=> new \Twig_Filter_Method($this, 'fetchY'),
    );
  }
  
  public function fetchX($position)
  {
    $p  = json_decode($position);
    return $p->x;
  }
  
  public function fetchY($position)
  {
    $p  = json_decode($position);
    return $p->y;
  }
  
  public function getName()
  {
    return 'twig_extension';
  }
}