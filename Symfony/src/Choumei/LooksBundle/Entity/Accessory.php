<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Choumei\LooksBundle\Entity\Accessory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\AccessoryRepository")
 */
class Accessory
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
     * @ORM\Column(name="looks_id", type="integer", length=8)
     */
    /**
     * @Assert\Blank()
     */
    
    private $looks_id;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;
    
    /**
     * @ORM\ManyToOne(targetEntity="Looks", inversedBy="accessories")
     * @ORM\JoinColumn(name="looks_id", referencedColumnName="id")
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
    
    public function __toString(){
      return $this->url;
    }

}