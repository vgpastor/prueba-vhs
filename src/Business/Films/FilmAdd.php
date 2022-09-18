<?php

namespace App\Business\Films;

use _PHPStan_52b7bec27\Nette\Neon\Exception;
use App\Entity\Film;
use App\Infrastructure\Business\FilmRepositoryInterface;
use App\Infrastructure\TMDB\ApiTMDBFilms;

/**
 * Logic to add a film into db
 * Verify if film exist in db
 * If not exist donwload info from TMDB and save it.
 */
class FilmAdd
{
    private ApiTMDBFilms $apiTMDBFilms;
    private FilmRepositoryInterface $filmRepository;

    public function __construct(
        ApiTMDBFilms $apiTMDBFilms,
        FilmRepositoryInterface $filmRepository
    ) {
        $this->apiTMDBFilms = $apiTMDBFilms;
        $this->filmRepository = $filmRepository;
    }

    /**
     * @throws Exception          The film doen't exist in TMDB
     * @throws FilmExistException The films exist
     */
    public function add(string $name): Film
    {
        // First search if film are in db
        $film = $this->filmRepository->findByName($name);
        if ($film) {
            throw new FilmExistException($film);
        }

        // Search film in TMDB
        $filmData = $this->apiTMDBFilms->findByName($name);
        if (!$filmData) {
            throw new Exception("The films doesn't exist in TMDB");
        }

        // Save the new film in DB
        $film = new Film();
        $film->setName($name);
        $film->setMovieDb($filmData);

        $this->filmRepository->save($film, true);

        return $film;
    }
}
