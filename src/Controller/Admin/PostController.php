<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\PostCreateType;
use App\Service\Post\Management\PostManagementServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class PostController extends AbstractController
{
    /**
     * @Route("/admin/post/create", name="admin_post_create")
     */
    public function create(Request $request, PostManagementServiceInterface $postManagement)
    {
        $form = $this->createForm(PostCreateType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $postManagement->create($form->getData());

            $this->addFlash(
                'success',
                \sprintf(
                    'Post was successfully created! You can see it by following URL %s',
                    $this->generateUrl('post_view', ['id' => $post->getId()], UrlGeneratorInterface::ABSOLUTE_URL)
                )
            );

            return $this->redirectToRoute('admin_post_create');
        }

        return $this->render('admin/post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
