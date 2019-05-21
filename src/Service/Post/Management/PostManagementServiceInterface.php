<?php
declare(strict_types=1);

namespace App\Service\Post\Management;

use App\Entity\Post;
use App\Form\Dto\PostCreateDto;

interface PostManagementServiceInterface
{
    public function create(PostCreateDto $dto): Post;
}
