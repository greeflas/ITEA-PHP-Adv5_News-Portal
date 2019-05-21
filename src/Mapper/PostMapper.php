<?php
declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Post;
use App\Form\Dto\PostCreateDto;
use App\Model\Category;
use App\Model\Post as PostModel;

final class PostMapper
{
    public static function entityToModel(Post $entity): PostModel
    {
        $category = $entity->getCategory();

        $model = new PostModel(
            $entity->getId(),
            new Category($category->getId(), $category->getSlug(), $category->getTitle()),
            $entity->getTitle()
        );

        $model
            ->setImage($entity->getImage())
            ->setShortDescription($entity->getShortDescription())
            ->setBody($entity->getBody())
            ->setPublicationDate($entity->getPublicationDate())
        ;

        return $model;
    }

    public static function dtoToEntity(PostCreateDto $dto): Post
    {
        $entity = new Post($dto->title);

        $entity
            ->setBody($dto->body)
            ->setShortDescription($dto->shortDescription)
            ->setImage($dto->image)
            ->setCategory($dto->category)
        ;

        return $entity;
    }
}
