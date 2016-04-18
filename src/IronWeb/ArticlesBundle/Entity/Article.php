<?php

namespace IronWeb\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="IronWeb\ArticlesBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ExclusionPolicy("all")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Expose
     */
    private $body;

    /**
     * @var Answer[]
     * @ORM\OneToMany(targetEntity="IronWeb\ArticlesBundle\Entity\Answer", mappedBy="article")
     * @Expose
     */
    private $answers;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose
     */
    private $createdAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="IronWeb\ArticlesBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Expose
     */
    private $user;

    /**
     * @var ArticleUserRating
     * @ORM\OneToMany(targetEntity="IronWeb\ArticlesBundle\Entity\ArticleUserRating", mappedBy="article")
     */
    private $articleUserRatings;

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
     * @return Article
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
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answers
     *
     * @param \IronWeb\ArticlesBundle\Entity\Answer $answers
     * @return Article
     */
    public function addAnswer(\IronWeb\ArticlesBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \IronWeb\ArticlesBundle\Entity\Answer $answers
     */
    public function removeAnswer(\IronWeb\ArticlesBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set createdAt
     *
     * @return Article
     * @ORM\PrePersist()
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

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
     * Set user
     *
     * @param \IronWeb\ArticlesBundle\Entity\User $user
     * @return Article
     */
    public function setUser(\IronWeb\ArticlesBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \IronWeb\ArticlesBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add articleUserRatings
     *
     * @param \IronWeb\ArticlesBundle\Entity\ArticleUserRating $articleUserRatings
     * @return Article
     */
    public function addArticleUserRating(\IronWeb\ArticlesBundle\Entity\ArticleUserRating $articleUserRatings)
    {
        $this->articleUserRatings[] = $articleUserRatings;

        return $this;
    }

    /**
     * Remove articleUserRatings
     *
     * @param \IronWeb\ArticlesBundle\Entity\ArticleUserRating $articleUserRatings
     */
    public function removeArticleUserRating(\IronWeb\ArticlesBundle\Entity\ArticleUserRating $articleUserRatings)
    {
        $this->articleUserRatings->removeElement($articleUserRatings);
    }

    /**
     * Get articleUserRatings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticleUserRatings()
    {
        return $this->articleUserRatings;
    }
}
