<?php

namespace IronWeb\FrontendBundle\Controller;

use IronWeb\FrontendBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/articles/new", name="frontend_article_new")
     * @Template("@IronWebFrontend/Article/new.html.twig")
     */
    public function indexAction()
    {
        $form = $this->createForm(ArticleType::class);
        return array(
            'form' => $form->createView()
        );
    }
}
