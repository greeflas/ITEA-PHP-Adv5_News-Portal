<?php
declare(strict_types=1);

namespace App\Service\Category;

use App\Model\Category;
use App\Mapper\CategoryMapper;
use App\Repository\Category\CategoryRepositoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class CategoryPresentationService implements CategoryPresentationServiceInterface
{
    private $categoryRepository;
    private $authorizationChecker;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function getBySlug(string $slug): ?Category
    {
        $entity = $this->categoryRepository->findBySlug($slug);

        if (null === $entity) {
            return null;
        }

        if ('science' === $entity->getSlug() && !$this->authorizationChecker->isGranted('ROLE_USER')) {
            return null;
        }

        $model = CategoryMapper::entityToModel($entity);

        return $model;
    }
}
