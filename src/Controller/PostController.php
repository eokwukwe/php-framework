<?php

namespace App\Controller;

use EOkwukwe\Framework\Http\Response;

class PostController
{
    public function show(int $id): Response
    {
        $content = "<h1>This is post $id </h1>";

        return new Response($content);
    }
}
