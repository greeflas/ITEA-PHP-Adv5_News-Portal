<?php
declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

abstract class AbstractFixture extends Fixture
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
