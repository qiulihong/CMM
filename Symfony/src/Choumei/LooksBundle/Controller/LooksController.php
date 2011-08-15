<?php

namespace Choumei\LooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Choumei\LooksBundle\Entity\Looks;
use Choumei\LooksBundle\Entity\Accessory;
use Choumei\LooksBundle\Form\LooksType;

require_once(dirname(__FILE__).'/../Resources/php.php');
/**
 * Looks controller.
 *
 * @Route("/looks")
 */
class LooksController extends Controller
{
    /**
     * Lists all Looks entities.
     *
     * @Route("/", name="looks")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChoumeiLooksBundle:Looks')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Looks entity.
     *
     * @Route("/{id}/show", name="looks_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Looks')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Looks entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Looks entity.
     *
     * @Route("/new", name="looks_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Looks();
        $form   = $this->createForm(new LooksType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Looks entity.
     *
     * @Route("/create", name="looks_create")
     * @Method("post")
     * @Template("ChoumeiLooksBundle:Looks:new.html.twig")
     */
    public function createAction()
    {
    /*
    //
    $looks	= new Looks();
	$accessory = new Accessory();
	
	$accessory->setUrl('kkkk');
	//$accessory->setLooks($entity);
	
	$looks->setTitle('kk title');
	$looks->setUserId(1);
	//$looks->setUser('Leon');
	$looks->addAccessories($accessory);
	$em	= $this->getDoctrine()->getEntityManager();
	$em->persist($looks);
	$em->persist($accessory);
	$em->flush();
    //
          // treat the collections
          $accessories  = $entity->getAccessories();
          foreach($accessories as $accessory){
            $accessory->setOwner( $entity );
            echo 'looks_id:' . $accessory->getLooksId();
          }
          exit();
        */
        $entity  = new Looks();
        $request = $this->getRequest();
        $form    = $this->createForm(new LooksType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
          $accessories  = $entity->getAccessories();
          foreach($accessories as $accessory){
            $accessory->setLooks( $entity );
            echo 'looks_id:' . $accessory->getLooksId();
          }
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('looks_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Looks entity.
     *
     * @Route("/{id}/edit", name="looks_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Looks')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Looks entity.');
        }

        $editForm = $this->createForm(new LooksType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Looks entity.
     *
     * @Route("/{id}/update", name="looks_update")
     * @Method("post")
     * @Template("ChoumeiLooksBundle:Looks:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChoumeiLooksBundle:Looks')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Looks entity.');
        }

        $editForm   = $this->createForm(new LooksType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('looks_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Looks entity.
     *
     * @Route("/{id}/delete", name="looks_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChoumeiLooksBundle:Looks')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Looks entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('looks'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     *  upload looks photo backend file
     *  invoked by fileuploader.js
     *  
     *  @Route("/upload", name="looks_upload")
     *  @Method("post")
     */
    public function uploadAction()
    {
       // list of valid extensions, ex. array("jpeg", "xml", "bmp")
      $allowedExtensions = array("jpeg","jpg","gif","png");
      // max file size in bytes
      $sizeLimit = 10 * 1024 * 1024;

      $uploader = new \qqFileUploader($allowedExtensions, $sizeLimit);
      $result = $uploader->handleUpload(dirname(__FILE__).'/../../../../web/uploads/');
      // to pass data through iframe you will need to encode all html tags
      echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);      
      exit;
    }
}
