<?php

namespace IronWeb\ArticlesBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;

class UserAPIController extends FOSRestController
{
    /**
     * @Get("/users/{id}/articles")
     */
    public function getArticlesByUserAction($id){
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $articles = $manager->getRepository("IronWebArticlesBundle:Article")
            ->getAllByUserId($id);
        return $articles;
    }
}
