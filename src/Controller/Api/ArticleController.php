<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Form\Dto\PostCreateDto;
use App\Service\Post\ApiPostPresentationInterface;
use App\Service\Post\ApiPostPresentationService;
use App\Service\Post\Management\ApiPostManagementService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ArticleController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/article")
     */
    public function postArticle(Request $request, ApiPostManagementService $service)
    {
        $data = $request->get('data', []);

        if (empty($data)) {
            throw new BadRequestHttpException();
        }

        $dto = PostCreateDto::fromState($data);

        $post = $service->create($dto);

        return $this->view($post, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/articles")
     */
    public function getArticles(Request $request, ApiPostPresentationService $service)
    {
        $page = $request->query->getInt('page', 1);

        $posts = $service->getAll($page);

        return $this->view($posts);
    }

    /**
     * @param int $id
     *
     * @Rest\Get("/article/{id}")
     */
    public function getArticle(int $id, ApiPostPresentationInterface $service)
    {
        $post = $service->getPost($id);

        if (null === $post) {
            throw $this->createNotFoundException();
        }

        return $this->view($post);
    }

    /**
     * @param int $id
     *
     * @Rest\Delete("/article/{id}")
     */
    public function deleteArticle(int $id, ApiPostManagementService $service)
    {
        $service->delete($id);

        return $this->view([], Response::HTTP_NO_CONTENT);
    }
}
