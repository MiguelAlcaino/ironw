<?php

namespace IronWeb\FrontendBundle\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @param int $id
     * @return Response
     * @Route("/user/{id}/articles", name="frontend_user_notifications")
     * @Template("@IronWebFrontend/User/notifications.html.twig")
     */
    public function userNotificationsAction($id)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $articles = $manager->getRepository("IronWebArticlesBundle:Article")->getAllByUserId($id);
        return array(
            'articles' => $articles
        );
    }
}
