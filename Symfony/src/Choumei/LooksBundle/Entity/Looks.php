<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Choumei\LooksBundle\Entity\Looks
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Looks
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255)
     * 
     */
    /**
     * 
     * @Assert\Blank()
     */
    private $url;

    /**
     * @var integer $user_id
     *
     * @ORM\Column(name="user_id", type="integer", length=8)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity="Accessory", mappedBy="looks", cascade={"all"})
     * @ORM\JoinColumn(name="id", referencedColumnName="looks_id")
     * )
     */
    private $accessories;
    
    /**
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="looks")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Style", inversedBy="looks")
     * 
     */
    private $styles;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="looks")
     */
    private $comments;
    
    /**
     * @ORM\ManyToOne(targetEntity="Choumei\SecurityBundle\Entity\User", inversedBy="looks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    public function __construct()
    {
      $this->accessories = new \Doctrine\Common\Collections\ArrayCollection();
      $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add accessories
     *
     * @param Choumei\LooksBundle\Entity\Accessory $accessory
     */
    public function addAccessories(\Choumei\LooksBundle\Entity\Accessory $accessory)
    {
        $this->accessories[] = $accessory;
    }

    /**
     * Get accessories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * Add tags
     *
     * @param Choumei\LooksBundle\Entity\Tag $tags
     */
    public function addTags(\Choumei\LooksBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add styles
     *
     * @param Choumei\LooksBundle\Entity\Style $styles
     */
    public function addStyles(\Choumei\LooksBundle\Entity\Style $styles)
    {
        $this->styles[] = $styles;
    }

    /**
     * Get styles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Add comments
     *
     * @param Choumei\LooksBundle\Entity\Comment $comments
     */
    public function addComments(\Choumei\LooksBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set user
     *
     * @param Choumei\SecurityBundle\Entity\User $user
     */
    public function setUser(\Choumei\SecurityBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Choumei\SecurityBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString()
    {
      return $this->title;
    }
}