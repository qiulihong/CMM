<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\SecurityBundle\Entity\UserFlower
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserFlower
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
     * @var integer $user_id
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var integer $flower_id
     *
     * @ORM\Column(name="flower_id", type="integer")
     */
    private $flower_id;

    /**
     * @var string $created_date
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $created_date;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userFlowers;
    
    /**
     * @ORM\ManyToOne(targetEntity="Flower")
     * @ORM\JoinColumn(name="flower_id", referencedColumnName="id")
     */
    private $flowers;


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

    /**
     * Set flower_id
     *
     * @param integer $flowerId
     */
    public function setFlowerId($flowerId)
    {
        $this->flower_id = $flowerId;
    }

    /**
     * Get flower_id
     *
     * @return integer 
     */
    public function getFlowerId()
    {
        return $this->flower_id;
    }

    /**
     * Set created_date
     *
     * @param string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;
    }

    /**
     * Get created_date
     *
     * @return string 
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Set userFlowers
     *
     * @param Choumei\SecurityBundle\Entity\User $userFlowers
     */
    public function setUserFlowers(\Choumei\SecurityBundle\Entity\User $userFlowers)
    {
        $this->userFlowers = $userFlowers;
    }

    /**
     * Get userFlowers
     *
     * @return Choumei\SecurityBundle\Entity\User 
     */
    public function getUserFlowers()
    {
        return $this->userFlowers;
    }

    /**
     * Set flowers
     *
     * @param Choumei\SecurityBundle\Entity\Flower $flowers
     */
    public function setFlowers(\Choumei\SecurityBundle\Entity\Flower $flowers)
    {
        $this->flowers = $flowers;
    }

    /**
     * Get flowers
     *
     * @return Choumei\SecurityBundle\Entity\Flower 
     */
    public function getFlowers()
    {
        return $this->flowers;
    }
    
}