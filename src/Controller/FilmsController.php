<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/films', name: 'api_films_')]
class FilmsController extends AbstractController
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

    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json([
            self::$filmDemo,
        ]);
    }

    #[Route('/', name: 'add', methods: ['POST'])]
    public function add(): JsonResponse
    {
        return $this->json(self::$filmDemo, 201);
    }
}
