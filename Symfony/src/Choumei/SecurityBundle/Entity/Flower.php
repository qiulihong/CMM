<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\SecurityBundle\Entity\Flower
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\SecurityBundle\Entity\FlowerRepository")
 */
class Flower
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\Column(name="icon_name", type="string", length=255)
     */
    private $icon_name;
    
    /**
     * @ORM\Column(name="icon_ext", type="string", length=3)
     */
    private $icon_ext;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="flowers")
     */
    private $users;
    
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add users
     *
     * @param Choumei\SecurityBundle\Entity\User $users
     */
    public function addUsers(\Choumei\SecurityBundle\Entity\User $users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}