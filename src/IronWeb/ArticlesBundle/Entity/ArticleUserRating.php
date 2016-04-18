<?php

namespace IronWeb\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticleUserRating
 *
 * @ORM\Table(name="article_user_rating")
 * @ORM\Entity(repositoryClass="IronWeb\ArticlesBundle\Repository\ArticleUserRatingRepository")
 */
class ArticleUserRating
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
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     * @Assert\Range(
     *     min=0,
     *     max=5,
     *     minMessage="The minimum value for the rating must be 0",
     *     maxMessage="The maximum value for the rating must be 5"
     * )
     */
    private $rating;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="IronWeb\ArticlesBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="IronWeb\ArticlesBundle\Entity\Article", inversedBy="articleUserRatings")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;


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
     * Set rating
     *
     * @param integer $rating
     * @return ArticleUserRating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set user
     *
     * @param \IronWeb\ArticlesBundle\Entity\User $user
     * @return ArticleUserRating
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
     * Set article
     *
     * @param \IronWeb\ArticlesBundle\Entity\Article $article
     * @return ArticleUserRating
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
}
