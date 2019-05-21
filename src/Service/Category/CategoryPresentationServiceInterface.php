<?php
declare(strict_types=1);

namespace App\Service\Category;

use App\Model\Category;

interface CategoryPresentationServiceInterface
{
    public function getBySlug(string $slug): ?Category;
}
