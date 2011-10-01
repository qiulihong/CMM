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
      /*
      $user  = $latestLooks[0]->getUser();
      $followers  = $user->getFollowers();
      $followings  = $user->getFollowings();
      foreach($followers as $follower){
        echo $follower->getFollower();
      }
      foreach($followings as $following){
        echo $following->getFollowing();
      }
      */
                                 
      //$imageThumb = $this->get('choumei_looks.imagethumb');
      return $this->render('ChoumeiWelcomeBundle:Default:index.html.twig', array('latestLooks'=> $latestLooks));
    }
}
