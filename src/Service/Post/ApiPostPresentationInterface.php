<?php
declare(strict_types=1);

namespace App\Service\Post;

use App\Collection\PostsCollection;
use App\Entity\Post;

interface ApiPostPresentationInterface
{
    public function getPost(int $id): ?Post;

    public function getAll(int $page): PostsCollection;
}
