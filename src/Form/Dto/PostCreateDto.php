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
}
