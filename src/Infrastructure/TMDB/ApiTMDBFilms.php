<?php

namespace App\Infrastructure\TMDB;

class ApiTMDBFilms extends ApiTMDB
{
    /**
     * https://developers.themoviedb.org/3/movies/get-movie-details
     *
     * @param int $filmId
     * @return array
     */
    public function findById(int $filmId):array
    {
        return $this->call('GET',"/movie/".$filmId);
    }

}
