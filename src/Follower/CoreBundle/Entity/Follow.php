<?php

namespace Follower\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 *
 * @ORM\Table(name="follow")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Follower\CoreBundle\Repository\FollowRepository")
 */
class Follow
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="follows")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="follows")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=TRUE)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=255, nullable=TRUE)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=TRUE)
     */
    private $userName;

    /**
     * @var bool
     *
     * @ORM\Column(name="followed", type="boolean", nullable=TRUE)
     */
    private $followed = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="blocked", type="boolean", nullable=true, nullable=TRUE)
     */
    private $blocked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

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
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }


    /**
     * @return boolean
     */
    public function isFollowed()
    {
        return $this->followed;
    }

    /**
     * @param boolean $followed
     */
    public function setFollowed($followed)
    {
        $this->followed = $followed;

        return $this;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     * @return Follow
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return boolean 
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Follow
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Follow
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set provider
     *
     * @param \Follower\CoreBundle\Entity\Provider $provider
     * @return Follow
     */
    public function setProvider(\Follower\CoreBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Follower\CoreBundle\Entity\Provider 
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set tag
     *
     * @param \Follower\CoreBundle\Entity\Tag $tag
     * @return Follow
     */
    public function setTag(\Follower\CoreBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Follower\CoreBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Get followed
     *
     * @return boolean 
     */
    public function getFollowed()
    {
        return $this->followed;
    }
}
