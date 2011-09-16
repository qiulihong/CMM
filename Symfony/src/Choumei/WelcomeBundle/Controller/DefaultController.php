<?php

namespace Choumei\WelcomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
      $em  = $this->getDoctrine()->getEntityManager();
      $repository  = $em->getRepository('ChoumeiLooksBundle:Looks');
      $latestLooks  = $repository->getAllLatestLooks();
      //var_dump($latestLooks[0]->getCreatedAt());exit;
                                 
      return $this->render('ChoumeiWelcomeBundle:Default:index.html.twig', array('latestLooks'=> $latestLooks));
    }
}
