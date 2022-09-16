<?php

namespace App\Controller;

use App\Business\Films\FilmAdd;
use App\Tests\Functional\APIControllerTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/films', name: 'api_films_')]
class FilmsController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json([
            APIControllerTest::$filmDemo,
        ]);
    }

    #[Route('/', name: 'add', methods: ['POST'])]
    public function add(FilmAdd $filmAdd): JsonResponse
    {
        return $this->json(APIControllerTest::$filmDemo, 201);
    }
}
