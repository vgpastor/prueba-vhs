<?php

namespace App\Controller;

use App\Business\Films\FilmAdd;
use App\Business\Films\FilmExistException;
use App\Infrastructure\Business\FilmRepositoryInterface;
use App\Tests\Functional\APIControllerTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/films', name: 'api_films_')]
class FilmsController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json([
            APIControllerTest::$filmDemo,
        ]);
    }

    #[Route('', name: 'add', methods: ['POST'])]
    public function add(FilmAdd $filmAdd, FilmRepositoryInterface $filmRepository, Request $request): JsonResponse
    {
        if (null === $request->get('name')) {
            return $this->json('Data missing. please read the docs', 400);
        }
        try {
            $film = $filmAdd->add($request->get('name'));

            return $this->json($film, 201);
        } catch (FilmExistException $e) {
            return $this->json($e->getFilm(), 200);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), 400);
        }
    }
}
