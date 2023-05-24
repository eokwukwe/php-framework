<?php

use App\Controller\HomeController;
use App\Controller\PostController;
use EOkwukwe\Framework\Http\Response;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostController::class, 'show']],
    ['GET', '/hello/{name:.+}', function (string $name) {
        return new Response("Hello $name");
    }],
    ['GET', '/posts', [PostController::class, 'create']],
    ['POST', '/posts', [PostController::class, 'store']],
];
