<?php

namespace Choumei\LooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Choumei\LooksBundle\Entity\ClothType;

/**
 * ClothType controller.
 *
 * @Route("/clothtype")
 */
class ClothTypeController extends Controller
{
    /**
     * Lists all ClothType entities.
     *
     * @Route("/", name="clothtype")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChoumeiLooksBundle:ClothType')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a ClothType entity.
     *
     * @Route("/{id}/show", name="clothtype_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:ClothType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClothType entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
    
    /**
     * return cloth types
     * 
     * @Route("/list", name="clothType_list")
     * @Template()
     */
    public function listAction()
    {
      $limit  = $this->getRequest()->get('limit');
      return array(
        'limit'	=> $limit,
      );
    }

}
