<?php
declare(strict_types=1);

namespace App\Service\Post;

use App\Model\Post;

interface PostPresentationInterface
{
    public function getPost(int $id): ?Post;
}
