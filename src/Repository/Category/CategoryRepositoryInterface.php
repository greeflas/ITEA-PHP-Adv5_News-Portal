<?php
declare(strict_types=1);

namespace App\Repository\Category;

use App\Entity\Category;

interface CategoryRepositoryInterface
{
    public function findBySlug(string $slug): ?Category;

    public function findById(int $id): ?Category;
}
