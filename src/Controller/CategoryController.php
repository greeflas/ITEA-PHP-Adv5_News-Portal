<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\Category\CategoryPresentationServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    /**
     * @param CategoryPresentationServiceInterface  $presentationService
     * @param string                                $slug
     *
     * @return Response
     *
     * @Route("/category/{slug}", name="category_view", requirements={"slug": "^[a-z0-9]+(?:-[a-z0-9]+)*$"})
     * @Method("GET")
     */
    public function view(string $slug, CategoryPresentationServiceInterface $presentationService): Response
    {
        $category = $presentationService->getBySlug($slug);

        if (null === $category) {
            throw $this->createNotFoundException('Category not found');
        }

        return $this->render('category/view.html.twig', [
            'category' => $category,
        ]);
    }
}
