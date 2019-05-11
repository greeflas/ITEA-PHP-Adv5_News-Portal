<?php
declare(strict_types=1);

namespace App\Service\Post;

use App\Model\Category;
use App\Model\Post;
use Faker\Factory;

final class FakePostPresentation implements PostPresentationInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getPost(int $id): ?Post
    {
        if ($this->faker->boolean(10)) {
            return null;
        }

        $post = new Post($id, new Category($this->faker->sentence), $this->faker->sentence);

        $body = '';
        $paragraphsNumber = \mt_rand(3, 10);

        for ($i = 0; $i < $paragraphsNumber; $i++) {
            $body .= '<p>' . $this->faker->sentences(\mt_rand(1, 6), true) . '</p>';
        }

        $post
            ->setBody($body)
            ->setPublicationDate($this->faker->dateTime)
        ;

        return $post;
    }
}
