<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $post = new Post($this->faker->sentence);
            $post
                ->setShortDescription($this->faker->sentence())
                ->setImage($this->faker->imageUrl())
            ;

            $body = '';
            $sentencesNumber = \mt_rand(3, 15);

            foreach ($this->provideSentence($sentencesNumber) as $sentence) {
                $body .= $sentence;
            }

            $post->setBody($body);

            if ($this->faker->boolean(80)) {
                $post->setPublicationDate(new \DateTime());
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    private function provideSentence(int $sentencesNumber)
    {
        for ($i = 0; $i < $sentencesNumber; $i++) {
            yield '<p>' . $this->faker->sentences(\mt_rand(1, 6), true) . '</p>';
        }
    }
}
