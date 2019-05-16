<?php
declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Post;
use App\Model\Category;
use App\Model\Post as PostModel;

final class PostMapper
{
    public static function entityToModel(Post $entity): PostModel
    {
        $model = new PostModel(
            $entity->getId(),
            new Category('TODO CATEGORY TITLE'),
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
}
