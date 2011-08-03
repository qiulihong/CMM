<?php

namespace Choumei\WelcomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('ChoumeiWelcomeBundle:Default:index.html.twig', array());
    }
}
