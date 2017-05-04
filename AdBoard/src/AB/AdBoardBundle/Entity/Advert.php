<?php

namespace AB\AdBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="AB\AdBoardBundle\Repository\AdvertRepository")
 */
class Advert
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=500)
     */
    private $description;

    /**
     * @ORM\Column(name="creation_time", type="datetime")
     */
    private $creationTime;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="adverts")
     * @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="adverts")
     * @ORM\JoinColumn(name="Category_id", referencedColumnName="id")
     */
    private $category;

    /**
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="advert")
     */
    private $comments;

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
     * Set title
     *
     * @param string $title
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Advert
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Advert
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set user
     *
     * @param \AB\AdBoardBundle\Entity\User $user
     * @return Advert
     */
    public function setUser(\AB\AdBoardBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AB\AdBoardBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \AB\AdBoardBundle\Entity\Category $category
     * @return Advert
     */
    public function setCategory(\AB\AdBoardBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AB\AdBoardBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Advert
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \AB\AdBoardBundle\Entity\Comment $comments
     * @return Advert
     */
    public function addComment(\AB\AdBoardBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AB\AdBoardBundle\Entity\Comment $comments
     */
    public function removeComment(\AB\AdBoardBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
