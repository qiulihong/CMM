<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Choumei\SecurityBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\SecurityBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Choumei\LooksBundle\Entity\Looks", mappedBy="user")
     */
    private $looks;

    /**
     * @ORM\OneToOne(targetEntity="Profile")
     */
    private $profile;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->looks = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }
    
    /**
     * Add looks
     *
     * @param Choumei\LooksBundle\Entity\Looks $looks
     */
    public function addLooks(\Choumei\LooksBundle\Entity\Looks $looks)
    {
        $this->looks[] = $looks;
    }

    /**
     * Get looks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLooks()
    {
        return $this->looks;
    }
    
    public function __toString()
    {
      return $this->username;
    }

    /**
     * Set profile
     *
     * @param Choumei\SecurityBundle\Entity\Profile $profile
     */
    public function setProfile(\Choumei\SecurityBundle\Entity\Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get profile
     *
     * @return Choumei\SecurityBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}