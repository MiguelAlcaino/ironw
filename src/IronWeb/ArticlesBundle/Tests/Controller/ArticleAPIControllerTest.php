<?php

namespace IronWeb\ArticlesBundle\Tests\Controller;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class ArticleAPIControllerTest extends WebTestCase
{
    public function testGetArticle(){
        $path = $this->getUrl(
            'api_1_get_article',
            array(
                'id' => 1
            )
        );

        $client = static::makeClient();
        $client->request("GET",$path);
        $this->isSuccessful($client->getResponse());
    }

    public function testPostNewArticle(){
        $path = $this->getUrl("api_1_post_article");

        $client = static::makeClient();
        $client->request(
            "POST",
            $path,
            array(
                'title' => 'Traveling to the moon with a car',
                'body' => 'These are the simple intructions to travel to the moon in 30 minutes.',
                'author_email' => 'miguel@ogb.cl'
            )
        );
        $this->isSuccessful($client->getResponse());
    }

    public function testPostRating(){
        $path = $this->getUrl("api_1_post_article_rating", array(
            'id' => 1
        ));

        $client = static::makeClient();
        $client->request(
            "POST",
            $path,
            array(
                'author_email' => 'ppppita@ogb.cl',
                'rate' => 5
            )
        );
        $this->isSuccessful($client->getResponse());
    }

    public function testPostAnswer(){
        $path = $this->getUrl("api_1_post_new_answer", array(
            'id' => 1
        ));

        $client = static::makeClient();
        $client->request(
            "POST",
            $path,
            array(
                'author_email' => 'ppppita@ogb.cl',
                'body' => 'This article has changed my life!'
            )
        );
        $this->isSuccessful($client->getResponse());
    }
}
