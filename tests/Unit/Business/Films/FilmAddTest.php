<?php

namespace App\Tests\Unit\Business\Films;

use _PHPStan_52b7bec27\Nette\Neon\Exception;
use App\Business\Films\FilmAdd;
use App\Business\Films\FilmExistException;
use App\Entity\Film;
use App\Infrastructure\Business\FilmRepositoryInterface;
use App\Infrastructure\TMDB\ApiTMDBFilms;
use App\Tests\Functional\APIControllerTest;
use PHPUnit\Framework\TestCase;

class FilmAddTest extends TestCase
{
    private FilmAdd $filmAdd;

    public function setUp(): void
    {
        $apiTMDBFilms = $this->createMock(ApiTMDBFilms::class);
        $apiTMDBFilms->method('findById')->willReturn(APIControllerTest::$filmDemo['full_details']);
        $apiTMDBFilms->method('findByName')->willReturn(APIControllerTest::$filmDemo['full_details']);

        $filmRepository = $this->createMock(FilmRepositoryInterface::class);

        $this->filmAdd = new FilmAdd($apiTMDBFilms, $filmRepository);
    }

    /**
     * @throws Exception
     * @throws FilmExistException
     */
    public function testAdd(): void
    {
        $filmDemo = new Film();
        $filmDemo->setName(APIControllerTest::$filmDemo['name']);
        $filmDemo->setMovieDb(APIControllerTest::$filmDemo['full_details']);

        $film = $this->filmAdd->add(APIControllerTest::$filmDemo['name']);

        $this->assertEquals($filmDemo, $film);
    }
}
