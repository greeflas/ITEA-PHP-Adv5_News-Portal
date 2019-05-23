<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $post = new Post($this->faker->sentence);
            $post
                ->setShortDescription($this->faker->sentence())
                ->setImage($this->faker->imageUrl())
                ->setCategory(
                    $this->getReference('category_' . \mt_rand(0, 3))
                )
            ;

            $body = '';
            $sentencesNumber = \mt_rand(3, 15);

            foreach ($this->provideSentence($sentencesNumber) as $sentence) {
                $body .= $sentence;
            }

            $post->setBody($body);

            if ($this->faker->boolean(80)) {
                $post->publish();
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

    private function provideSentence(int $sentencesNumber)
    {
        for ($i = 0; $i < $sentencesNumber; $i++) {
            yield '<p>' . $this->faker->sentences(\mt_rand(1, 6), true) . '</p>';
        }
    }
}
