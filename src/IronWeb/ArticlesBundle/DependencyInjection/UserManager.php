<?php

namespace IronWeb\ArticlesBundle\DependencyInjection;


use IronWeb\ArticlesBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserManager
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * UserManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns a new or existent User Object depending on the email
     * @param string $email
     * @return User
     */
    public function createOrGetUserByEmail($email){
        $manager = $this->container->get('doctrine.orm.entity_manager');

        $user = $manager->getRepository("IronWebArticlesBundle:User")->findOneBy(array(
            'email' => $email
        ));

        if(is_null($user)){
            $user = new User($email);
            $manager->persist($user);
        }
        return $user;
    }

}