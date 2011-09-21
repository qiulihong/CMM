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
    
    return $this->render( 'ChoumeiSecurityBundle:Security:login.html.twig', array(
      'last_username'	=> $session->get( SecurityContext::LAST_USERNAME),
      'error'	=> $error,
    ));
  }
    public function indexAction($name)
    {
        return $this->render('ChoumeiSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function topUsersAction()
    {
      $mockData  = array();
      for($i=0; $i<30; $i++){
        array_push($mockData, time().'adfasdfkajdflajflajdflsjfjsdlfjaljdflskjflsjdfkjslfjlsdjfjdjfksjfk<br />skdfjsldkfj');
      }
      
      exit(implode("~", $mockData));
    }
    
    public function editAvatarAction()
    {
      $request  = $this->getRequest();
      if( 'POST' === $request->getMethod() ){
        exit('kkk');
      }else{
        return $this->render('ChoumeiSecurityBundle:Security:edit_avatar.html.twig', array());
      }
    }
}
