<?php
declare(strict_types=1);

namespace App\Service\Post\Management;

use App\Entity\Post;
use App\Exception\EntityNotFoundException;
use App\Form\Dto\PostCreateDto;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Post\PostRepositoryInterface;

final class ApiPostManagementService extends PostManagementService
{
    private $categoryRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct($postRepository);

        $this->categoryRepository = $categoryRepository;
    }
    
    public function create(PostCreateDto $dto): Post
    {
        $category = $this->categoryRepository->findById($dto->category);

        if (null === $category) {
            throw new EntityNotFoundException('Category not found');
        }

        $dto->category = $category;

        return parent::create($dto);
    }
}
