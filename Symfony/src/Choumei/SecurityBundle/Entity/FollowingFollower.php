<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\SecurityBundle\Entity\FollowingFollower
 *
 * @ORM\Table(name="following_follower")
 * @ORM\Entity
 */
class FollowingFollower
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
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $follower;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="following_id", referencedColumnName="id")
     */
    private $following;

    /**
     * @var datetime $created_date
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $created_date;
    

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
     * Set created_date
     *
     * @param datetime $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;
    }

    /**
     * Get created_date
     *
     * @return datetime 
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Set following
     *
     * @param Choumei\SecurityBundle\Entity\User $following
     */
    public function setFollowing(\Choumei\SecurityBundle\Entity\User $following)
    {
        $this->following = $following;
    }

    /**
     * Get following
     *
     * @return Choumei\SecurityBundle\Entity\User 
     */
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * Set follower
     *
     * @param Choumei\SecurityBundle\Entity\User $follower
     */
    public function setFollower(\Choumei\SecurityBundle\Entity\User $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get follower
     *
     * @return Choumei\SecurityBundle\Entity\User 
     */
    public function getFollower()
    {
        return $this->follower;
    }
}