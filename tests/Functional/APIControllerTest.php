<?php

namespace App\Tests\Functional;

use App\Controller\FilmsController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public function testListVHS(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/films/');
        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertGreaterThanOrEqual(1, count($data));
        $this->assertContains(FilmsController::$filmDemo, $data);
    }

    public function testAddVHS(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/films/', [
            'name' => 'Spider-Man: No Way Home',
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
        $data = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertGreaterThanOrEqual(1, count($data));
        $this->assertEquals(FilmsController::$filmDemo, $data);
    }
}
