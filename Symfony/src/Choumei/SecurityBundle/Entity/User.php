<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="Choumei\LooksBundle\Entity\Vote", mappedBy="user")
     */
    private $votes;

    /**
     * @ORM\Column(name="location", type="string")
     */
    protected $location;
    
    /**
     * @ORM\Column(name="dob", type="date", nullable=true)
     */
    protected $dob = null;
    
    /**
     * //@ORM\Column(name="gender", type="string", columnDefinition="ENUM('male', 'female')")
     * @ORM\Column(name="gender", type="string")
     */
    protected $gender;
    
    /**
     * @ORM\Column(name="nickname", type="string", length=128)
     * @Assert\MaxLength(limit=128, message="昵称最长128字符", groups={"Profile","Registration"})
     */
    private $nickname;
    
    /**
     * @ORM\Column(name="avatar", type="string")
     */
    private $avatar;
    
    /**
     * @ORM\OneToMany(targetEntity="UserFlower", mappedBy="userFlowers")
     */
    private $flowers;
    
    
    /**
     * //@ORM\ManyToMany(targetEntity="User")
     * //@ORM\JoinTable(name="following_follower", 
     *		//joinColumns={@ORM\JoinColumn(name="following_id", referencedColumnName="id")},
     * 		/inverseJoinColumns={@ORM\JoinColumn(name="follower_id", referencedColumnName="id")}
     * //)
     */
    
    /**
     * @ORM\OneToMany(targetEntity="FollowingFollower", mappedBy="follower")
     */
    private $followings;
    
    /**
     * //@ORM\ManyToMany(targetEntity="User", mappedBy="followings")
     * @ORM\OneToMany(targetEntity="FollowingFollower", mappedBy="following")
     */
    private $followers;
    
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

    /**
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set dob
     *
     * @param date $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * Get dob
     *
     * @return date 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add vote
     *
     * @param Choumei\LooksBundle\Entity\Vote $vote
     */
    public function addVote(\Choumei\LooksBundle\Entity\Vote $vote)
    {
        $this->vote[] = $vote;
    }

    /**
     * Get vote
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Add flowers
     *
     * @param Choumei\SecurityBundle\Entity\Flower $flowers
     */
    public function addFlowers(\Choumei\SecurityBundle\Entity\Flower $flowers)
    {
        $this->flowers[] = $flowers;
    }

    /**
     * Get flowers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFlowers()
    {
        return $this->flowers;
    }

    /**
     * Add followings
     *
     * @param Choumei\SecurityBundle\Entity\FollowingFollower $followings
     */
    public function addFollowings(\Choumei\SecurityBundle\Entity\FollowingFollower $followings)
    {
        $this->followings[] = $followings;
    }

    /**
     * Get followings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFollowings()
    {
        return $this->followings;
    }

    /**
     * Add followers
     *
     * @param Choumei\SecurityBundle\Entity\FollowingFollower $followers
     */
    public function addFollowers(\Choumei\SecurityBundle\Entity\FollowingFollower $followers)
    {
        $this->followers[] = $followers;
    }

    /**
     * Get followers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFollowers()
    {
        return $this->followers;
    }
    
    /**
     * is followed or not other user
     */
    public function isFollowedBy($userId)
    {
      $isFollowed = false;
      $followers  = $this->getFollowers();
      foreach( $followers as $follower){
        if( $follower->getFollower()->getId() == $userId ){
          return true;
        }
      }
      return $isFollowed;
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
     * Add flowers
     *
     * @param Choumei\SecurityBundle\Entity\UserFlower $flowers
     */
    public function addUserFlower(\Choumei\SecurityBundle\Entity\UserFlower $flowers)
    {
        $this->flowers[] = $flowers;
    }

    /**
     * Add followings
     *
     * @param Choumei\SecurityBundle\Entity\FollowingFollower $followings
     */
    public function addFollowingFollower(\Choumei\SecurityBundle\Entity\FollowingFollower $followings)
    {
        $this->followings[] = $followings;
    }
}