<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public static array $filmDemo = [
        'name' => 'Spider-Man: No Way Home',
        'full_details' => [
            'adult' => false,
            'backdrop_path' => '/14QbnygCuTO0vl7CAFmPf1fgZfV.jpg',
            'genre_ids' => [
                28,
                12,
                878,
            ],
            'id' => 634649,
            'original_language' => 'en',
            'original_title' => 'Spider-Man: No Way Home',
            'overview' => 'Peter Parker es desenmascarado y por tanto no es capaz de separar su vida normal de los enormes riesgos que conlleva ser un súper héroe. Cuando pide ayuda a Doctor Strange, los riesgos pasan a ser aún más peligrosos, obligándole a descubrir lo que realmente significa ser Spider-Man. website: https://hbo.vkstreaming.co/',
            'popularity' => 1317.341,
            'poster_path' => '/miZFgV81xG324rpUknQX8dtXuBl.jpg',
            'release_date' => '2021-12-15',
            'title' => 'Spider-Man: No Way Home',
            'video' => false,
            'vote_average' => 8,
            'vote_count' => 15113,
        ],
    ];

    /**
     * @throws \JsonException
     *
     * @required testAddVHS
     */
    public function testListVHS(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/films');
        $this->assertResponseIsSuccessful();
        if (false === $client->getResponse()->getContent()) {
            $this->assertStringContainsString('', $client->getResponse()->getContent());
        }
        $data = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertGreaterThanOrEqual(1, count($data));
    }

    public function testAddVHS(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/films', [
            'name' => 'Spider-Man: No Way Home',
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertGreaterThanOrEqual(1, count($data));
        $this->assertEquals(self::$filmDemo, $data);
    }
}
