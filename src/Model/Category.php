<?php
declare(strict_types=1);

namespace App\Model;

use App\Collection\PostCollection;

final class Category
{
    private $id;
    private $slug;
    private $name;
    private $posts;

    public function __construct(int $id, string $slug, string $name)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setPosts(PostCollection $posts): void
    {
        $this->posts = $posts;
    }

    public function getPosts(): PostCollection
    {
        return $this->posts;
    }
}
