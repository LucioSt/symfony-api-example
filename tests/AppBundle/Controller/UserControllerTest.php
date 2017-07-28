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
    public function testNewUserAction()
    {

        $client = static::createClient();


        $crawler = $client->request(
            'GET',
            '/user',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            ''
        );

        $response = $client->getResponse();

        // Test if response is OK
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        // Test if Content-Type is valid application/json
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        // Test if company was inserted
        //$this->assertEquals('{"success":"true"}', $response->getContent());
        // Test that response is not empty
        $this->assertNotEmpty($client->getResponse()->getContent());

        //$this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());

    }
}
