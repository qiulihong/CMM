<?php

namespace Choumei\LooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Choumei\LooksBundle\Entity\Looks;
use Choumei\LooksBundle\Entity\Vote;
use Choumei\LooksBundle\Entity\Accessory;
use Choumei\LooksBundle\Entity\Comment;
use Choumei\LooksBundle\Form\LooksType;
use Choumei\LooksBundle\Form\CommentType;
use JMS\SecurityExtraBundle\Annotation\Secure;

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
        $repository  = $em->getRepository('ChoumeiLooksBundle:Looks');
        
        
        //$looks  = $repository->getLatestLooks();

        $entities = $repository->findAll();

        return array('entities' => $entities, 'current'=>'looks');
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

        $comment  = new Comment();
        $comment->setLooks($entity);
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
	        $comment->setUser($this->get('security.context')->getToken()->getUser());
	        $comment->setCommentId(0);
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $commentForm  = $this->createForm(new CommentType, $comment);

        return array(
	        'entity'      => $entity,
	        'looks'		  => $entity,
	        'delete_form' => $deleteForm->createView(),        
            'comment_form'	=> $commentForm->createView(),
        );
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
      // build top category choices
      /*
        $em = $this->getDoctrine()->getEntityManager();
        $typeRepo  = $em->getRepository('ChoumeiLooksBundle:ClothType');
        $topCategories  = $typeRepo->getTypes();
        $choices  =  array();
        foreach($topCategories as $category){
          $choices[$category->getId()]  = $category->getName();
        }
        */

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
        $entity  = new Looks();
        $request = $this->getRequest();
        if( !$request->get('user') ) {
          $user  = $this->get('security.context')->getToken()->getUser();
          $entity->setUser($user);
        }
        $form    = $this->createForm(new LooksType(), $entity);
        $form->bindRequest($request);

        /*
        $em = $this->getDoctrine()->getEntityManager();
        $typesRepo  = $em->getRepository('ChoumeiLooksBundle:ClothType');
        */

        if ($form->isValid()) {
          // set relation for accessories and tags
          // TODO: maybe one day Symfony2.0 will fix this problem, so Doctrine will look after this
          //       work not need me to set it explicity
          $accessories  = $entity->getAccessories();
          foreach($accessories as $accessory){
            $accessory->setLooks( $entity );
            //echo 'looks_id:' . $accessory->getLooksId();
          }
          $tags  = $entity->getTags();
          foreach( $tags as $tag ) {
            $tag->setLooks( $entity );
          }
          //end set relations
          $user  = $this->get('security.context')->getToken()->getUser();
          $entity->setUser( $user );
          
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            // create ACL
            $aclProvider  = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);
            // retrieving the currently logged-in user
            $securityObject  = UserSecurityIdentity::fromAccount($user);
            $roleSecurityObject  = new RoleSecurityIdentity('ROLE_ADMIN');
            // grant owner permissions
            $acl->insertObjectAce($securityObject, MaskBuilder::MASK_OWNER);
            $acl->insertObjectAce($roleSecurityObject, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

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
        
        // check permission, only owner and admin can edit
	    $securityContext  = $this->get('security.context');
	    if( false === $securityContext->isGranted('EDIT', $entity) ){
	      throw new AccessDeniedException(); 
	    }

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
      // TODO: upload dir need to be configured in config file
      $result = $uploader->handleUpload(dirname(__FILE__).'/../../../../web/uploads/');
      $result['img_url']  = '/uploads/';
      $result['img_path']  = dirname(__FILE__).'/../../../../web/uploads/';
      // to pass data through iframe you will need to encode all html tags
      echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);      
      exit;
    }
    
    /**
     * 
     * do Crop work here
     * 
     * @Route("/crop", name="looks_crop")
     * @Method("post")
     */
    public function cropAction()
    {
      //list($width, $height) = getimagesize($_POST["imageSource"]);
      // TODO: swap web dir to product path
      //$imgRealPath  = '/Users/leonqiu/www/choumei.me/Symfony/web/' . $_POST['imageSource'];
      $imgRealPath  = dirname(__FILE__) . '/../../../../web/' . $_POST['imageSource'];
      list($width, $height) = getimagesize($imgRealPath);
      
      $viewPortW = $_POST["viewPortW"];
	  $viewPortH = $_POST["viewPortH"];
      $pWidth = $_POST["imageW"];
      $pHeight =  $_POST["imageH"];
      $tmp  = explode(".",$_POST["imageSource"]);
      $ext = end(&$tmp);
      $function = $this->returnCorrectFunction($ext);
      //$image = $function($_POST["imageSource"]);
      $image = $function($imgRealPath);
      $width = imagesx($image);
      $height = imagesy($image);
      
      // Resample
      $image_p = imagecreatetruecolor($pWidth, $pHeight);
      $this->setTransparency($image,$image_p,$ext);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $pWidth, $pHeight, $width, $height);
		imagedestroy($image);
		$widthR = imagesx($image_p);
		$hegihtR = imagesy($image_p);
		
		$selectorX = $_POST["selectorX"];
		$selectorY = $_POST["selectorY"];
		
		if($_POST["imageRotate"]){
		        $angle = 360 - $_POST["imageRotate"];
		        $image_p = imagerotate($image_p,$angle,0);
		       
		        $pWidth = imagesx($image_p);
		        $pHeight = imagesy($image_p);
		       
		        //print $pWidth."---".$pHeight;
		
		        $diffW = abs($pWidth - $widthR) / 2;
		        $diffH = abs($pHeight - $hegihtR) / 2;
		               
		        $_POST["imageX"] = ($pWidth > $widthR ? $_POST["imageX"] - $diffW : $_POST["imageX"] + $diffW);
		        $_POST["imageY"] = ($pHeight > $hegihtR ? $_POST["imageY"] - $diffH : $_POST["imageY"] + $diffH);
		
		       
		}
		
		$dst_x = $src_x = $dst_y = $src_y = 0;
		
		if($_POST["imageX"] > 0){
		        $dst_x = abs($_POST["imageX"]);
		}else{
		        $src_x = abs($_POST["imageX"]);
		}
		if($_POST["imageY"] > 0){
		        $dst_y = abs($_POST["imageY"]);
		}else{
		        $src_y = abs($_POST["imageY"]);
		}
		
		
		$viewport = imagecreatetruecolor($_POST["viewPortW"],$_POST["viewPortH"]);
		$this->setTransparency($image_p,$viewport,$ext);
		
		imagecopy($viewport, $image_p, $dst_x, $dst_y, $src_x, $src_y, $pWidth, $pHeight);
		imagedestroy($image_p);
		
		
		$selector = imagecreatetruecolor($_POST["selectorW"],$_POST["selectorH"]);
		$this->setTransparency($viewport,$selector,$ext);
		imagecopy($selector, $viewport, 0, 0, $selectorX, $selectorY,$_POST["viewPortW"],$_POST["viewPortH"]);
		
		//$file = "tmp/test".time().".".$ext;
		// TODO: generate file name
		$fileName  = uniqid() . "." . $ext;
		$file  = dirname(__FILE__).'/../../../../web/uploads/'.$fileName;
		$fileUrl  = '/uploads/'. $fileName;
		$this->parseImage($ext,$selector,$file);
		imagedestroy($viewport);
		//Return value
		echo $fileUrl;
		exit;
    }
    
	/* Functions For Crop&resize */
	
	private function determineImageScale($sourceWidth, $sourceHeight, $targetWidth, $targetHeight) {
	        $scalex =  $targetWidth / $sourceWidth;
	        $scaley =  $targetHeight / $sourceHeight;
	        return min($scalex, $scaley);
	}
	
	private function returnCorrectFunction($ext){
	        $function = "";
	        switch($ext){
	                case "png":
	                        $function = "imagecreatefrompng";
	                        break;
	                case "jpeg":
	                        $function = "imagecreatefromjpeg";
	                        break;
	                case "jpg":
	                        $function = "imagecreatefromjpeg";
	                        break;
	                case "gif":
	                        $function = "imagecreatefromgif";
	                        break;
	        }
	        return $function;
	}
	
	private function parseImage($ext,$img,$file = null){
	        switch($ext){
	                case "png":
	                        imagepng($img,($file != null ? $file : ''));
	                        break;
	                case "jpeg":
	                        imagejpeg($img,($file ? $file : ''),90);
	                        break;
	                case "jpg":
	                        imagejpeg($img,($file ? $file : ''),90);
	                        break;
	                case "gif":
	                        imagegif($img,($file ? $file : ''));
	                        break;
	        }
	}
	
	private function setTransparency($imgSrc,$imgDest,$ext){
	
	        if($ext == "png" || $ext == "gif"){
	                $trnprt_indx = imagecolortransparent($imgSrc);
	                // If we have a specific transparent color
	                if ($trnprt_indx >= 0) {
	                        // Get the original image's transparent color's RGB values
	                        $trnprt_color    = imagecolorsforindex($imgSrc, $trnprt_indx);
	                        // Allocate the same color in the new image resource
	                        $trnprt_indx    = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
	                        // Completely fill the background of the new image with allocated color.
	                        imagefill($imgDest, 0, 0, $trnprt_indx);
	                        // Set the background color for new image to transparent
	                        imagecolortransparent($imgDest, $trnprt_indx);
	                }
	                // Always make a transparent background color for PNGs that don't have one allocated already
	                elseif ($ext == "png") {
	                        // Turn off transparency blending (temporarily)
	                        imagealphablending($imgDest, true);
	                        // Create a new transparent color for image
	                        $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
	                        // Completely fill the background of the new image with allocated color.
	                        imagefill($imgDest, 0, 0, $color);
	                        // Restore transparency blending
	                        imagesavealpha($imgDest, true);
	                }
	
	        }
	}

    
    /**
     * Finds and displays most fashion chics
     *
     * @Route("/chics", name="looks_chics")
     * @Template()
     */
	public function chicsAction(){
	  
	}
	
    /**
     * browse by brands
     *
     * @Route("/brands", name="looks_brands")
     * @Template()
     */
	public function brandsAction(){
	  
	}
	
    /**
     * browse one brand
     *
     * @Route("/brand/{brandName}", name="looks_view_brand")
     * @Template()
     */
	public function viewBrandAction($brandName){
	  echo $brandName;exit;
	}
	
	/**
	 * display latest flower awards
	 * 
	 * @Route("/flowers/new-awards", name="looks_flowers_new_awards")
	 * @Template()
	 */
	public function newFlowersAwards()
	{
	  
	}
	
	/**
	 * Vote looks
	 * 
	 * @Route("/vote", name="looks_vote")
	 * @Method("post")
	 * @Template()
	 */
	public function voteAction()
	{
	  $request  = $this->getRequest();
	  
	  $userId  = $request->get("user_id");
	  $looksId  = $request->get("looks_id");
	  
	  $remoteAddr  = $_SERVER['REMOTE_ADDR'];
	  
	  $em  = $this->getDoctrine()->getEntityManager();
	  
	  $looksRepo = $em->getRepository('ChoumeiLooksBundle:Looks');
	  $looks  = $looksRepo->find($looksId);
	  $votedUserIds  = $looks->getVotedUserIds();
	  if ( in_array($userId, $votedUserIds)){
	    exit(json_encode(array('success'=>false, 'message'=>'您已经投过票了:)')));
	  }else{
		  $vote  = new Vote();
		  
		  $vote->setLooks($looks);
		  $vote->setRemoteAddr($remoteAddr);
		  $vote->setUserId($userId);
		  $em->persist($vote);
		  $em->flush();
		  
		  exit(json_encode(array('success'=>true, 'message'=>'感谢亲的支持哦', 'user_id'=>$userId, 'remote_addr'=>$remoteAddr, 'count'=>count($votedUserIds)+1)));
	  }
	}
	
	/**
	 * @Route("/most_popular", name="looks_most_popular")
	 * @Template()
	 */
	public function mostPopularAction()
	{
	}
	
	/**
	 * @Route("/most_latest", name="looks_most_latest")
	 * @Template()
	 */
	public function mostLatestAction()
	{
	}
	
	/**
	 * @Route("/my_following", name="looks_my_following")
	 * @Template()
	 */
	public function myFollowingAction()
	{
	  
	}
	
}
