<?php

namespace App\Controller;

use App\Widget;
use EOkwukwe\Framework\Http\Response;

class HomeController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index(): Response
    {
        $content = "<h1>Hello, {$this->widget->name}!</h1>";

        return new Response($content);
    }
}
