<?php

namespace App\Controller;

use App\Widget;

use EOkwukwe\Framework\Http\Response;
use EOkwukwe\Framework\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index(): Response
    {
        // dd($this->container->get('twig'));
        // $content = "<h1>Hello, {$this->widget->name}!</h1>";

        // return new Response($content);

        $template = "<h1>Hello {{ name }}</h1>";

        return $this->render('home.html.twig');
    }
}
