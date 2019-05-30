<?php
declare(strict_types=1);

namespace App\Service\Post;

use App\Collection\PostsCollection;
use App\Entity\Post;
use App\Repository\Post\PostRepositoryInterface;

final class ApiPostPresentationService implements ApiPostPresentationInterface
{
    private $postRepository;
    private $paginationPageLimit;

    public function __construct(
        int $paginationPageLimit,
        PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
        $this->paginationPageLimit = $paginationPageLimit;
    }

    public function getPost(int $id): ?Post
    {
        $post = $this->postRepository->findById($id);

        if (null === $post) {
            return null;
        }

        return $post;
    }

    public function getAll(int $page): PostsCollection
    {
        $posts = $this->postRepository->findAllPaginated($page, $this->paginationPageLimit);

        return new PostsCollection(...$posts);
    }
}
