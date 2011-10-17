<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Choumei\LooksBundle\Entity\Vote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Vote
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
     * @var integer $looks_id
     * 
     * @ORM\Column(name="looks_id", type="integer")
     */
    private $looks_id;
    
    /**
     * @var remote_addr
     * 
     * @ORM\Column(name="remote_addr", type="string")
     */
    private $remote_addr;
    
    /**
     * @ORM\ManyToOne(targetEntity="Looks")
     * @ORM\JoinColumn(name="looks_id", referencedColumnName="id")
     */
    private $looks;
    
    /**
     * @ORM\ManyToOne(targetEntity="Choumei\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
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
     * @ORM\Column(type="integer")
     */
    private $user_id;

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
     * Set looks_id
     *
     * @param integer $looksId
     */
    public function setLooksId($looksId)
    {
        $this->looks_id = $looksId;
    }

    /**
     * Get looks_id
     *
     * @return integer 
     */
    public function getLooksId()
    {
        return $this->looks_id;
    }

    /**
     * Set remote_addr
     *
     * @param string $remoteAddr
     */
    public function setRemoteAddr($remoteAddr)
    {
        $this->remote_addr = $remoteAddr;
    }

    /**
     * Get remote_addr
     *
     * @return string 
     */
    public function getRemoteAddr()
    {
        return $this->remote_addr;
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
     * Set looks
     *
     * @param Choumei\LooksBundle\Entity\Looks $looks
     */
    public function setLooks(\Choumei\LooksBundle\Entity\Looks $looks)
    {
        $this->looks = $looks;
    }

    /**
     * Get looks
     *
     * @return Choumei\LooksBundle\Entity\Looks 
     */
    public function getLooks()
    {
        return $this->looks;
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
    
}