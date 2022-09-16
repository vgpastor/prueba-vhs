<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Tests\Functional\APIControllerTest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $film = new Film();
        $film->setName(APIControllerTest::$filmDemo['name']);
        $film->setMovieDb(APIControllerTest::$filmDemo['full_details']);
        $manager->persist($film);

        $manager->flush();
    }
}
