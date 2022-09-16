<?php

namespace App\Business\Films;

use App\Infrastructure\TMDB\ApiTMDBFilms;

class FilmAdd
{
    private ApiTMDBFilms $apiTMDBFilms;

    public function __construct(ApiTMDBFilms $apiTMDBFilms)
    {
        $this->apiTMDBFilms = $apiTMDBFilms;
    }

    public function add(int $filmId, string $name)
    {
        // TODO: Implement __call() method.
    }
}
