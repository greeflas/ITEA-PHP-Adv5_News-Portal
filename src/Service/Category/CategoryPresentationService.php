<?php
declare(strict_types=1);

namespace App\Service\Category;

use App\Model\Category;
use App\Mapper\CategoryMapper;
use App\Repository\Category\CategoryRepositoryInterface;

final class CategoryPresentationService implements CategoryPresentationServiceInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getBySlug(string $slug): ?Category
    {
        $entity = $this->categoryRepository->findBySlug($slug);

        if (null === $entity) {
            return null;
        }

        $model = CategoryMapper::entityToModel($entity);

        return $model;
    }
}
