<?php

namespace App\Infrastructure\TMDB;

class ApiTMDBFilms extends ApiTMDB
{
    /**
     * https://developers.themoviedb.org/3/movies/get-movie-details.
     */
    public function findById(int $filmId): ?array
    {
        return $this->call('GET', '/movie/'.$filmId);
    }

    /**
     * https://developers.themoviedb.org/3/search/search-movies.
     */
    public function findByName(string $name): ?array
    {
        $results = $this->call('GET', '/search/movie', [
            'query' => $name,
        ]);

        if (!isset($results['results']) || count($results['results']) <= 0) {
            return null;
        }

        return $results['results'][0];
    }
}
