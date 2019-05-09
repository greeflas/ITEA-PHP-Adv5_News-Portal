<?php

namespace App\Controller;

use App\Service\HomePage\HomePageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class DefaultController extends AbstractController
{
    public function index(HomePageServiceInterface $homePageService): Response
    {
        $posts = $homePageService->getPosts();

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
