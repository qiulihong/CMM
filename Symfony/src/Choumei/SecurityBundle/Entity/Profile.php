<?php

namespace Choumei\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\SecurityBundle\Entity\Profile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\SecurityBundle\Entity\ProfileRepository")
 */
class Profile
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
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var datetime $dob
     *
     * @ORM\Column(name="dob", type="datetime")
     */
    private $dob;

    /**
     * @var text $avatar
     *
     * @ORM\Column(name="avatar", type="text")
     */
    private $avatar;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string")
     */
    private $gender;

    /**
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="string", length=128)
     */
    private $nickname;


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
     * @param datetime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * Get dob
     *
     * @return datetime 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set avatar
     *
     * @param text $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Get avatar
     *
     * @return text 
     */
    public function getAvatar()
    {
        return $this->avatar;
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
}