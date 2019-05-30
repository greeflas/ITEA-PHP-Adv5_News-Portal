<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\HomePage\HomePageServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @return JsonResponse
     *
     * @Route("/api/ping")
     */
    public function ping(): JsonResponse
    {
        return $this->json([
            'message' => 'Pong!',
        ]);
    }
}
