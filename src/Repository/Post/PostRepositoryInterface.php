<?php
declare(strict_types=1);

namespace App\Repository\Post;

use App\Entity\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;

    public function save(Post $post): void;

    public function delete(Post $post): void;

    public function findAllPaginated(int $page, int $limit): iterable;
}
