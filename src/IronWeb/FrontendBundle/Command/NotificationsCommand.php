<?php

namespace IronWeb\FrontendBundle\Command;

use IronWeb\ArticlesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotificationsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('ironweb:notifications')
            ->setDescription('Sends an email to writers of articles if they have notifications for more than 24 hours');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $users = $manager->getRepository("IronWebArticlesBundle:User")->getAllWithAnswersOlderThan24Hours(false);
        foreach ($users as $user){
            $message = \Swift_Message::newInstance()
                ->setSubject("You have notifications waiting for you!")
                ->setFrom("hello@ogb.cl")
                ->setTo($user->getEmail())
                ->setBody(
                    $this->getContainer()->get('templating')
                        ->render("@IronWebFrontend/Emails/notificationsEmail.html.twig",array(
                            'user' => $user
                        ))
                );
        }
        
    }
}
