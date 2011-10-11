<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Choumei\LooksBundle\Entity\Looks
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\LooksRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="looks", cascade={"all"})
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
     */
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="looks")
     */
    private $votes;
    
    /**
     * @var datetime $created_at
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    
    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;
    
    
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

    
    public function __toString()
    {
      return $this->title;
    }
    
    /**
     * @ORM\prePersist()
     */
    public function setUserIdValue()
    {
    }

    /**
     * Set user
     *
     * @param Choumei\LooksBundle\Entity\user $user
     */
    //public function setUser(\Choumei\LooksBundle\Entity\user $user)
    public function setUser(\FOS\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Choumei\LooksBundle\Entity\user 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    

    /**
     * Add accessories
     *
     * @param Choumei\LooksBundle\Entity\Accessory $accessories
     */
    public function addAccessory(\Choumei\LooksBundle\Entity\Accessory $accessories)
    {
        $this->accessories[] = $accessories;
    }

    /**
     * Add tags
     *
     * @param Choumei\LooksBundle\Entity\Tag $tags
     */
    public function addTag(\Choumei\LooksBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Add styles
     *
     * @param Choumei\LooksBundle\Entity\Style $styles
     */
    public function addStyle(\Choumei\LooksBundle\Entity\Style $styles)
    {
        $this->styles[] = $styles;
    }

    /**
     * Add comments
     *
     * @param Choumei\LooksBundle\Entity\Comment $comments
     */
    public function addComment(\Choumei\LooksBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Add votes
     *
     * @param Choumei\LooksBundle\Entity\Vote $votes
     */
    public function addVote(\Choumei\LooksBundle\Entity\Vote $votes)
    {
        $this->votes[] = $votes;
    }

    /**
     * Get votes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }
    
    /**
     * Get all user ids who voted the current looks
     * Enter description here ...
     */
    public function getVotedUserIds()
    {
      $votes  = $this->getVotes();
      $userIds  = array();
      
      foreach($votes as $vote){
        $userIds[] = $vote->getUserId();
      }
      
      return $userIds;
    }
}