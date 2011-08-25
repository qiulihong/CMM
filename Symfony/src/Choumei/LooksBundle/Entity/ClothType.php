<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections;

/**
 * Choumei\LooksBundle\Entity\ClothType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\ClothTypeRepository")
 */
class ClothType
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
     * @ORM\OneToMany(targetEntity="Choumei\LooksBundle\Entity\ClothType", mappedBy="parent")
     */
    private $children;
    
    /**
     * @ORM\ManyToOne(targetEntity="Choumei\LooksBundle\Entity\ClothType", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent_id;

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
    
    public function __construct()
    {
      $this->children  = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add children
     *
     * @param Choumei\LooksBundle\Entity\ClothType $children
     */
    public function addChildren(\Choumei\LooksBundle\Entity\ClothType $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent_id
     *
     * @param Choumei\LooksBundle\Entity\ClothType $parentId
     */
    public function setParentId(\Choumei\LooksBundle\Entity\ClothType $parentId)
    {
        $this->parent_id = $parentId;
    }

    /**
     * Get parent_id
     *
     * @return Choumei\LooksBundle\Entity\ClothType 
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
    
    public function __toString()
    {
      return $this->name;
    }
    
}