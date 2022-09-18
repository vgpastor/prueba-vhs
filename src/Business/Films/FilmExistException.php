<?php

namespace App\Business\Films;

use App\Entity\Film;

class FilmExistException extends \Exception
{
    private Film $film;

    public function __construct(Film $film, string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        $this->film = $film;
        parent::__construct($message, $code, $previous);
    }

    public function getFilm(): Film
    {
        return $this->film;
    }
}
