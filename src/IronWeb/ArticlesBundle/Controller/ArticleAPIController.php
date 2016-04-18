<?php

namespace IronWeb\ArticlesBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use IronWeb\ArticlesBundle\Entity\Answer;
use IronWeb\ArticlesBundle\Entity\Article;
use IronWeb\ArticlesBundle\Entity\ArticleUserRating;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleAPIController extends FOSRestController
{
    /**
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets an article for a given id",
     *   output = "Article",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     * @param int $id Article's id
     * @return array|Article
     * @Get("/articles/{id}", requirements={"_format":"json"})
     */
    public function getArticleAction($id){
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        return $manager->getRepository("IronWebArticlesBundle:Article")->getOneById($id);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Posts an article",
     *     output="Article",
     *     statusCodes={
     *       200 = "Returned when successful.",
     *       400 = "Returned when something went wrong with the request."
     *     }
     * )
     * @param ParamFetcher $paramFetcher
     * @Post("/articles", requirements={"_format":"json"})
     * @RequestParam(name="title", nullable=false, strict=true, description="The title of the article.")
     * @RequestParam(name="body", nullable=false, strict=true, description="The body of the article.")
     * @RequestParam(name="author_email", nullable=false, strict=true, description="The email of the article's author")
     * @return View
     */
    public function postArticleAction(ParamFetcher $paramFetcher){
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $article = new Article();
        $article->setTitle($paramFetcher->get('title'));
        $article->setBody($paramFetcher->get('body'));

        $user = $this->get('user_manager')->createOrGetUserByEmail($paramFetcher->get('author_email'));

        $article->setUser($user);

        $manager->persist($article);
        $manager->flush();

        return $manager->getRepository("IronWebArticlesBundle:Article")->getOneById($article->getId());
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Posts an answer for a given Article id",
     *     output="Article",
     *     statusCodes={
     *       200 = "Returned when successful.",
     *       400 = "Returned when something went wrong with the request."
     *     }
     * )
     * @param int $id Article's id
     * @param ParamFetcher $paramFetcher
     * @return View
     * @Post("/articles/{id}/answers", requirements={"_format":"json"})
     * @RequestParam(name="body", nullable=false, strict=true, description="The body of the answer.")
     * @RequestParam(name="author_email", nullable=false, strict=true, description="The email of the answer's author")
     */
    public function postNewAnswerAction($id, ParamFetcher $paramFetcher){
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $article = $manager->getRepository("IronWebArticlesBundle:Article")->find($id);
        if(is_null($article)){
            throw new HttpException(Response::HTTP_CONFLICT, "The article was not found");
        }
        $answer = new Answer();
        $answer->setBody($paramFetcher->get('body'));
        $answer->setArticle($article);

        $user = $this->get('user_manager')->createOrGetUserByEmail($paramFetcher->get('author_email'));

        $answer->setUser($user);
        $manager->persist($answer);
        $manager->flush();

        return $manager->getRepository("IronWebArticlesBundle:Article")->getOneById($id);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Rates an article by a given Article id",
     *     output="Article",
     *     statusCodes={
     *       200 = "Returned when successful.",
     *       400 = "Returned when something went wrong with the request."
     *     }
     * )
     *
     * @param int $id Article's id
     * @param ParamFetcher $paramFetcher
     * @return View
     * @Post("/articles/{id}/rate", requirements={"_format":"json"})
     * @RequestParam(name="rate", nullable=false, strict=true, description="The value between 0 and 5 to rate an article.")
     * @RequestParam(name="author_email", nullable=false, strict=true, description="The email of the user who is rating the article.")
     */
    public function postArticleRatingAction($id, ParamFetcher $paramFetcher){
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $article = $manager->getRepository("IronWebArticlesBundle:Article")->find($id);
        if(is_null($article)){
            throw new HttpException(Response::HTTP_CONFLICT, "The article was not found");
        }

        $user = $this->get('user_manager')->createOrGetUserByEmail($paramFetcher->get('author_email'));

        $articleUserRating = new ArticleUserRating();
        $articleUserRating->setUser($user);
        $articleUserRating->setArticle($article);
        $articleUserRating->setRating($paramFetcher->get('rate'));

        $manager->persist($articleUserRating);
        $manager->flush();

        return $manager->getRepository("IronWebArticlesBundle:Article")->getOneById($id);
    }
    
}
