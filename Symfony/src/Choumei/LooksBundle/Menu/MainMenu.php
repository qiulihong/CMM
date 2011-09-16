<?php
// LooksBundle\Menu\MainMenu.php
namespace Choumei\LooksBundle\Menu;

use Knp\Bundle\MenuBundle\Menu;
use Knp\Bundle\MenuBundle\MenuItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class MainMenu extends Menu
{
  /**
   * @param Request $request
   * @param Router $router
   */
  public function __construct(Request $request, Router $router)
  {
    parent::__construct(array('id'=>'root'));
    
    $this->setCurrentUri( $request->getRequestUri() );
    
    $this->addChild('搭配', $router->generate('_welcome'), array('id'=>'jj', 'class'=>'cls-1'));
    $this['搭配']->addChild('sub1','',array('id'=>'s1'));
    $this['搭配']->addChild('sub2', '', array('id'=>'s2'));
    $this->addChild('时尚达人', '', array('id'=>'xxx'));
    $this->addChild('品牌、分类');
    
  }
}
