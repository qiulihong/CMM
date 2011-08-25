<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\LooksBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\TagRepository")
 */
class Tag
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
     * @var integer $type_id
     *
     * @ORM\Column(name="type_id", type="integer", length=4)
     */
    private $type_id;
    
    /**
     * @var integer $brand_id
     *
     * @ORM\Column(name="brand_id", type="integer", length=4)
     */
    private $brand_id;
    
    /**
     * @var text $url_or_location
     *
     * @ORM\Column(name="url_or_location", type="text")
     */
    private $url_or_location;

    /**
     * @var integer $look_id
     *
     * @ORM\Column(name="look_id", type="integer", length=8)
     */
    private $look_id;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string", length=255)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Looks", inversedBy="tags")
     * 
     */
    private $looks;

    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     */
    private $brand;
    
    /**
     * @ORM\ManyToOne(targetEntity="ClothType")
     * 
     */
    private $clothType;
    
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
     * Set type_id
     *
     * @param integer $typeId
     */
    public function setTypeId($typeId)
    {
        $this->type_id = $typeId;
    }

    /**
     * Get type_id
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set brand_id
     *
     * @param integer $brandId
     */
    public function setBrandId($brandId)
    {
        $this->brand_id = $brandId;
    }

    /**
     * Get brand_id
     *
     * @return integer 
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set url_or_location
     *
     * @param text $urlOrLocation
     */
    public function setUrlOrLocation($urlOrLocation)
    {
        $this->url_or_location = $urlOrLocation;
    }

    /**
     * Get url_or_location
     *
     * @return text 
     */
    public function getUrlOrLocation()
    {
        return $this->url_or_location;
    }

    /**
     * Set look_id
     *
     * @param integer $lookId
     */
    public function setLookId($lookId)
    {
        $this->look_id = $lookId;
    }

    /**
     * Get look_id
     *
     * @return integer 
     */
    public function getLookId()
    {
        return $this->look_id;
    }

    /**
     * Set position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
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
     * Set brand
     *
     * @param Choumei\LooksBundle\Entity\Brand $brand
     */
    public function setBrand(\Choumei\LooksBundle\Entity\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get brand
     *
     * @return Choumei\LooksBundle\Entity\Brand 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set clothType
     *
     * @param Choumei\LooksBundle\Entity\ClothType $clothType
     */
    public function setClothType(\Choumei\LooksBundle\Entity\ClothType $clothType)
    {
        $this->clothType = $clothType;
    }

    /**
     * Get clothType
     *
     * @return Choumei\LooksBundle\Entity\ClothType 
     */
    public function getClothType()
    {
        return $this->clothType;
    }
}