<?php

use App\Controller\HomeController;
use App\Controller\PostController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostController::class, 'show']],
];
