<?php

namespace Choumei\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller
{
    
  public function loginAction()
  {
    $request  = $this->getRequest();
    $session  = $request->getSession();
    
    /// get login error
    if( $request->attributes->has( SecurityContext::AUTHENTICATION_ERROR)){
      $error  = $request->attributes->get( SecurityContext::AUTHENTICATION_ERROR );
    }else{
      $error  = $session->get( SecurityContext::AUTHENTICATION_ERROR);
    }
    
    return $this->render( 'ChoumeiSecurityBundle:Security:login.html.php', array(
      'last_username'	=> $session->get( SecurityContext::LAST_USERNAME),
      'error'	=> $error,
    ));
  }
    public function indexAction($name)
    {
        return $this->render('ChoumeiSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
