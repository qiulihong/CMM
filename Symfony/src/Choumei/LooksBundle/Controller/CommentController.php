<?php

namespace Choumei\LooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Choumei\LooksBundle\Entity\Comment;
use Choumei\LooksBundle\Form\CommentType;

class CommentController extends Controller
{
    /**
     * @Route("/comment/add", name="looks_comment_add")
     * @Template()
     */
    public function addAction()
    {
      $comment = new Comment();
      
      $commentForm  = $this->createForm( new CommentType(), $comment);
      
      return array(
      	'comment_form' => $commentForm->createView(),
      );
    }
    
    /**
     * @Route("/comment/create", name="looks_comment_create")
     */
    public function createAction()
    {
      $entity  = new Comment();
      
      $request  = $this->getRequest();
        //echo 'kk'. $request->get('looks_id');exit;
      $user  = $this->get('security.context')->getToken()->getUser();
      
      $form  = $this->createForm(new CommentType(), $entity);
      $form->bindRequest($request);
      if( $form->isValid() ){
        $em  = $this->getDoctrine()->getEntityManager();
        
        // get looks
        $looks  = $em->getRepository('ChoumeiLooksBundle:Looks')->find($request->get('looks_id'));
        $entity->setUser($user);
        $entity->setLooks($looks);
        $em->persist($entity);
        $em->flush();
        
        $retArray  = array(
          'username'	=> $user->getUsername(),
          'comment'		=> $entity->getContent(),
        );
        exit(json_encode($retArray));
      }
    }
    
}
