<?php
declare(strict_types=1);

namespace App\Service\Post\Management;

use App\Entity\Post;
use App\Exception\EntityNotFoundException;
use App\Form\Dto\PostCreateDto;
use App\Mapper\PostMapper;
use App\Repository\Post\PostRepositoryInterface;

class PostManagementService implements PostManagementServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(PostCreateDto $dto): Post
    {
        $post = PostMapper::dtoToEntity($dto);

        $post->publish();

        $this->postRepository->save($post);

        return $post;
    }

    public function delete(int $id): void
    {
        $post = $this->postRepository->findById($id);

        if (null === $post) {
            throw new EntityNotFoundException('Post not found');
        }

        $this->postRepository->delete($post);
    }
}
