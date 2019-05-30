<?php
declare(strict_types=1);

namespace App\Form\Dto;

final class PostCreateDto
{
    public $title;
    public $body;
    public $shortDescription;
    public $category;
    public $image;
    public $publish;

    public static function fromState(array $state): self
    {
        $self = new self();
        $self->title = $state['title'];
        $self->body = $state['body'];
        $self->shortDescription = $state['short_description'];
        $self->category = $state['category_id'];
        $self->image = $state['image'];
        $self->publish = $state['publish'];

        return $self;
    }
}
