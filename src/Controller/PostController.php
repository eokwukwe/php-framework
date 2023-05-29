<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostMapper;
use App\Repository\PostRepository;
use EOkwukwe\Framework\Http\Response;
use EOkwukwe\Framework\Controller\AbstractController;
use EOkwukwe\Framework\Http\RedirectResponse;
use EOkwukwe\Framework\Session\SessionInterface;

class PostController extends AbstractController
{
    public function __construct(
        private PostMapper $postMapper,
        private SessionInterface $session,
        private PostRepository $postRepository
    ) {
    }

    public function show(int $id): Response
    {
        $post = $this->postRepository->findOrFail($id);

        return $this->render('post.html.twig', [
            'post' => $post
        ]);
    }

    public function create(): Response
    {
        return $this->render('create-post.html.twig');
    }

    public function store()
    {
        $title = $this->request->postParams['title'];
        $body = $this->request->postParams['body'];

        $post = Post::create($title, $body);


        $this->postMapper->save($post);

        $this->session->setFlash(
            'success',
            sprintf('Post "%s" successfully created', $title)
        );

        return new RedirectResponse('/posts');
    }
}
