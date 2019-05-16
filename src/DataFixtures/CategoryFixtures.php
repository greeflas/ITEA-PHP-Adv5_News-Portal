<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $category) {
            $category = new Category($category);

            $this->addReference('category_' . $key, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
