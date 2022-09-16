<?php

namespace App\Tests\Functional;

use App\Controller\FilmsController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public static array $filmDemo = [
        'name' => 'Spider-Man: No Way Home',
        'full_details' => [
            'adult' => false,
            'backdrop_path' => '/iQFcwSGbZXMkeyKrxbPnwnRo5fl.jpg',
            'genre_ids' => [
                28,
                12,
                878,
            ],
            'id' => 634649,
            'original_language' => 'en',
            'original_title' => 'Spider-Man: No Way Home',
            'overview' => 'Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.',
            'popularity' => 6120.418,
            'poster_path' => '/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg',
            'release_date' => '2021-12-15',
            'title' => 'Spider-Man: No Way Home',
            'video' => false,
            'vote_average' => 8.2,
            'vote_count' => 11355,
        ],
    ];

    public function testListVHS(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/films/');
        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertGreaterThanOrEqual(1, count($data));
        $this->assertContains(self::$filmDemo, $data);
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
        $this->assertEquals(self::$filmDemo, $data);
    }
}
