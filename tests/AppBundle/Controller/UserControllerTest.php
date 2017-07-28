<?php
/**
 * Created by PhpStorm.
 * User: lucio
 * Date: 27/07/17
 * Time: 12:44
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/index');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
