<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\LooksBundle\Entity\Style
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\StyleRepository")
 */
class Style
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
     * @ORM\ManyToMany(targetEntity="Looks", mappedBy="styles")
     * 
     * Enter description here ...
     * @var unknown_type
     */
    private $looks;


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
        $this->looks = new \Doctrine\Common\Collections\ArrayCollection();
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
}