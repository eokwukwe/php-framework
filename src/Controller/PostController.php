<?php

namespace App\Controller;

use EOkwukwe\Framework\Http\Response;
use EOkwukwe\Framework\Controller\AbstractController;

class PostController extends AbstractController
{
    public function show(int $id): Response
    {
        return $this->render('post.html.twig', [
            'postId' => $id
        ]);
    }

    public function create(): Response
    {
        return $this->render('create-post.html.twig');
    }
}
