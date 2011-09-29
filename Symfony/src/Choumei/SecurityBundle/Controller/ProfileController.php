<?php

/**
 * @author Leon
 * @version 0.0.1
 * 
 * overide FOSUser's edit profile action, return to profile 
 * edit page instead of profile show page.
 */

namespace Choumei\SecurityBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

use FOS\UserBundle\Controller\ProfileController as BaseController;

class ProfileController extends BaseController 
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $uid  = $this->container->get('request')->query->get('uid');
        $em  = $this->container->get('doctrine')->getEntityManager();
        $userRepo  = $em->getRepository('ChoumeiSecurityBundle:User');
        if( $uid ){
          $user  = $userRepo->findOneById($uid);
        }
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }

    /**
     * Edit the user
     */
    public function editAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->container->get('fos_user.profile.form');
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));
        }

        return $this->container->get('templating')->renderResponse(
            'FOSUserBundle:Profile:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
            array('form' => $form->createView(), 'theme' => $this->container->getParameter('fos_user.template.theme'))
        );
    }

}
