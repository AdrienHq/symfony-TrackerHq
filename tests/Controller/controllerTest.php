<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class controllerTest extends WebTestCase
{
    public function testIngredientsPage()
    {
        $client = static::createClient();
        $client = $client->request('GET','/ingredients');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1','Ingredients');
    }

    public function testLoginPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1','Se connecter');
        $this->assertSelectorNotExists('alert alert-danger');
    }

    public function testLoginFailPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/login');
        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'test',
            '_password' => 'mauvaisPwd'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();
        $this->assertSelectorExists('alert alert-danger');
    }
}