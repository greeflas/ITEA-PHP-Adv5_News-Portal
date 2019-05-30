<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\Post;

final class PostsCollection implements \JsonSerializable
{
    private $posts;

    public function __construct(Post ...$posts)
    {
        $this->posts = $posts;
    }

    public function jsonSerialize()
    {
        return $this->posts;
    }
}
