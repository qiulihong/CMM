<?php

namespace Choumei\LooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Choumei\LooksBundle\Entity\Brand;
use Choumei\LooksBundle\Form\BrandType;

/**
 * Brand controller.
 *
 */
class BrandController extends Controller
{
    /**
     * Lists all Brand entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChoumeiLooksBundle:Brand')->findAll();

        return $this->render('ChoumeiLooksBundle:Brand:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Brand entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Brand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brand entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChoumeiLooksBundle:Brand:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Brand entity.
     *
     */
    public function newAction()
    {
        $entity = new Brand();
        $form   = $this->createForm(new BrandType(), $entity);

        return $this->render('ChoumeiLooksBundle:Brand:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Brand entity.
     *
     */
    public function createAction()
    {
        $entity  = new Brand();
        $request = $this->getRequest();
        $form    = $this->createForm(new BrandType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('brand_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ChoumeiLooksBundle:Brand:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Brand entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Brand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brand entity.');
        }

        $editForm = $this->createForm(new BrandType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChoumeiLooksBundle:Brand:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Brand entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Brand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brand entity.');
        }

        $editForm   = $this->createForm(new BrandType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('brand_edit', array('id' => $id)));
        }

        return $this->render('ChoumeiLooksBundle:Brand:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Brand entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChoumeiLooksBundle:Brand')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Brand entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('brand'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function latestBrandsAction()
    {
      /*
      $limit = $this->getRequest()->get('max');
      $entityManager  = $this->getDoctrine()->getEntityManager();
      $brandRepo  = $entityManager->getRepository('ChoumeiLooksBundle:Brand');
      
      $latestBrands = $brandRepo->getLatestBrands($limit);
      */
      return $this->render('ChoumeiLooksBundle:Brand:latest.html.twig');
    }
}
