<?php

namespace IronWeb\ArticlesBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use IronWeb\ArticlesBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * @param bool $returnArray
     * @return array|User[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getAllWithAnswersOlderThan24Hours($returnArray = true){

        $raw_query = "
                    SELECT 
                        u.id as article_user_id,
                        u.email as article_user_email
                    FROM answer an
                    LEFT JOIN article a ON an.article_id = a.id
                    LEFT JOIN user u ON u.id = a.user_id
                    WHERE an.seen_by_article_author = :seen_by_article_author 
                    AND TIMESTAMPDIFF(HOUR, an.created_at, NOW()) > :hours
                    GROUP BY u.id";
        $rsm  = new ResultSetMapping();
        $rsm->addEntityResult("IronWebArticlesBundle:User","u")
            ->addFieldResult("u","article_user_id","id")
            ->addFieldResult("u","article_user_email","email");

        $query = $this->getEntityManager()->createNativeQuery($raw_query,$rsm);
        $query->setParameter("seen_by_article_author", false)
            ->setParameter("hours",24);

        return $returnArray ?  $query->getArrayResult() : $query->getResult();
    }
}
