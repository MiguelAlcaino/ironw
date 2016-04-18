<?php

namespace IronWeb\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="IronWeb\ArticlesBundle\Repository\AnswerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Answer
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
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="IronWeb\ArticlesBundle\Entity\Article", inversedBy="answers")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $article;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="IronWeb\ArticlesBundle\Entity\User", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @var bool
     * @ORM\Column(name="seen_by_article_author", type="boolean")
     */
    private $seenByArticleAuthor;

    /**
     * Answer constructor.
     */
    public function __construct()
    {
        $this->seenByArticleAuthor = false;
    }


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
     * Set body
     *
     * @param string $body
     * @return Answer
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
     * Set article
     *
     * @param \IronWeb\ArticlesBundle\Entity\Article $article
     * @return Answer
     */
    public function setArticle(\IronWeb\ArticlesBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \IronWeb\ArticlesBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set createdAt
     *
     * @return Answer
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
     * @return Answer
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
     * Set seenByArticleAuthor
     *
     * @param boolean $seenByArticleAuthor
     * @return Answer
     */
    public function setSeenByArticleAuthor($seenByArticleAuthor)
    {
        $this->seenByArticleAuthor = $seenByArticleAuthor;

        return $this;
    }

    /**
     * Get seenByArticleAuthor
     *
     * @return boolean 
     */
    public function getSeenByArticleAuthor()
    {
        return $this->seenByArticleAuthor;
    }
}
