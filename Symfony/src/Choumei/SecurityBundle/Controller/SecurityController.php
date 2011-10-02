<?php

namespace Choumei\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

require_once(dirname(__FILE__).'/../../LooksBundle/Resources/php.php');

class SecurityController extends Controller
{
    
  public function loginAction()
  {
    $request  = $this->getRequest();
    $session  = $request->getSession();
    
    /// get login error
    if( $request->attributes->has( SecurityContext::AUTHENTICATION_ERROR)){
      $error  = $request->attributes->get( SecurityContext::AUTHENTICATION_ERROR );
    }else{
      $error  = $session->get( SecurityContext::AUTHENTICATION_ERROR);
    }
    
    return $this->render( 'ChoumeiSecurityBundle:Security:login.html.twig', array(
      'last_username'	=> $session->get( SecurityContext::LAST_USERNAME),
      'error'	=> $error,
    ));
  }
    public function indexAction($name)
    {
        return $this->render('ChoumeiSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function topUsersAction()
    {
      $mockData  = array();
      for($i=0; $i<30; $i++){
        array_push($mockData, time().'adfasdfkajdflajflajdflsjfjsdlfjaljdflskjflsjdfkjslfjlsdjfjdjfksjfk<br />skdfjsldkfj');
      }
      
      exit(implode("~", $mockData));
    }
    
    public function cropAvatarAction()
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
		
		$dst_x = $src_x = $dst_y = $dst_x = 0;
		
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
		$user  = $this->get('security.context')->getToken()->getUser();
		$avatarFile  = dirname(__FILE__).'/../../../../web/uploads/avatar/'.$user->getId(). '/' .$fileName;
		$avatarUrl   = '/uploads/avatar/'. $user->getId() . '/' . $fileName;
		$this->parseImage($ext,$selector,$avatarFile);
		imagedestroy($viewport);
		//Return value
		//update avatar
        $em  = $this->getDoctrine()->getEntityManager();
        $user->setAvatar($avatarUrl);
        $em->persist($user);
        $em->flush();
		echo $avatarUrl;
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

    public function editAvatarAction()
    {
      $request  = $this->getRequest();
      $user  = $this->get('security.context')->getToken()->getUser();
      
      if( 'POST' === $request->getMethod() ){
	       // list of valid extensions, ex. array("jpeg", "xml", "bmp")
	      $allowedExtensions = array("jpeg","jpg","gif","png");
	      // max file size in bytes
	      $sizeLimit = 10 * 1024 * 1024;
	
	      $uploader = new \qqFileUploader($allowedExtensions, $sizeLimit);
	      // TODO: upload dir need to be configured in config file
	      //if(!is_dir(dirname(__FILE__).'/../../../../web/uploads/avatar/' . $user->getId())){
	     //   createdir(dirname(__FILE__).'/../../../../web/uploads/avatar/' . $user->getId());
	     // chmod 0777;
	      //}
	      //$result = $uploader->handleUpload(dirname(__FILE__).'/../../../../web/uploads/avatar/' . $user->getId() .'/', FALSE, array('width'=>100, 'height'=>100));
	      $result = $uploader->handleUpload(dirname(__FILE__).'/../../../../web/uploads/avatar/' . $user->getId() .'/');
	      $result['img_path']  = dirname(__FILE__).'/../../../../web/uploads/avatar/' . $user->getId();
	      $result['img_path_url']  = '/uploads/avatar/' . $user->getId();
	      $result['user_id']  = $user->getId();
	      // to pass data through iframe you will need to encode all html tags
	      //echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);      
        exit(htmlspecialchars(json_encode(array('success'=>true, 'result'=>$result)), ENT_NOQUOTES));
        //exit(json_encode(array('success'=>true, 'result'=>$result)));
      }else{
        return $this->render('ChoumeiSecurityBundle:Security:edit_avatar.html.twig', array('user'=>$user));
      }
    }
    
    public function newFlowersAction()
    {
      $em = $this->getDoctrine()->getEntityManager();
      $userFlowerRepository  = $em->getRepository('ChoumeiSecurityBundle:UserFlower');
      $flowers  = $userFlowerRepository->findAll();
      
      $tmp  = array();
      foreach( $flowers as $flower ){
        $ret = '<p class="container" style="margin:0;padding:0;border:1px solid #fff;"><p class="column span-2" style="margin-right:0px;"><img src="'.$flower->getUserFlowers()->getAvatar().'" width="50" height="50" /></p><p class="column span-4" style="font-size:0.7em;"><span><a href="'.$this->generateUrl('fos_user_profile_show', array('uid'=>$flower->getUserFlowers()->getId())).'">'. $flower->getUserFlowers()->getUsername().'</a></span> 现在是 '.$flower->getFlowers()->getName().'</span><p class="column span-1-1 last"><img src="/images/flowers/'.$flower->getFlowers()->getIconName().'-small.'.$flower->getFlowers()->getIconExt().'" width="50" height="50" /><p></p>';
        //echo $flower->getUserFlowers()->getAvatar();
        //echo '-';
        //echo $flower->getFlowers()->getName();
        //echo '<br />';
          array_push($tmp, $ret);
      }
      exit(implode('~', $tmp));
    }
}
