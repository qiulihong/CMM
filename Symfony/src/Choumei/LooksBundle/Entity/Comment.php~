<?php

namespace Choumei\LooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choumei\LooksBundle\Entity\Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Choumei\LooksBundle\Entity\CommentRepository")
 */
class Comment
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
     * @var integer $look_id
     *
     * @ORM\Column(name="look_id", type="integer")
     */
    private $look_id;

    /**
     * @var integer $user_id
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var integer $comment_id
     *
     * @ORM\Column(name="comment_id", type="integer")
     */
    private $comment_id;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @ORM\ManyToOne(targetEntity="Looks", inversedBy="comments")
     * 
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
     * Set comment_id
     *
     * @param integer $commentId
     */
    public function setCommentId($commentId)
    {
        $this->comment_id = $commentId;
    }

    /**
     * Get comment_id
     *
     * @return integer 
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
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
}