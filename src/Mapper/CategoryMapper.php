<?php
declare(strict_types=1);

namespace App\Mapper;

use App\Collection\PostCollection;
use App\Entity\Category;
use App\Model\Category as CategoryModel;

final class CategoryMapper
{
    public static function entityToModel(Category $entity): CategoryModel
    {
        $model = new CategoryModel(
            $entity->getId(),
            $entity->getSlug(),
            $entity->getTitle()
        );

        $posts = new PostCollection();

        foreach ($entity->getPosts() as $post) {
            $posts->addPost(PostMapper::entityToModel($post));
        }

        $model->setPosts($posts);

        return $model;
    }
}
