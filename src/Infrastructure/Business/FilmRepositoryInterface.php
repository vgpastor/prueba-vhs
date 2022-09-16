<?php

namespace App\Infrastructure\Business;

use App\Entity\Film;

interface FilmRepositoryInterface
{
    public function findById(int $id): Film;

    public function findByName(string $name): Film;

    public function findAll(): array;

    public function save(Film $film, bool $flush = false): void;

    public function remove(Film $film, bool $flush = false): void;
}
