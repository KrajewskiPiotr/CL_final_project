<?php

namespace AB\AdBoardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testShowmain()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
