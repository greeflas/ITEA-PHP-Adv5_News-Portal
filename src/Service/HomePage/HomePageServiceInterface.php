<?php

namespace App\Service\HomePage;

use App\Collection\PostCollection;

interface HomePageServiceInterface
{
    public function getPosts(): PostCollection;
}
