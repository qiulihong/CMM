<?php

namespace Choumei\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('ChoumeiHelloBundle:Default:index.html.twig', array('name' => $name));
    }
}
