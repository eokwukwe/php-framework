<?php // framework/src/Controller/AbstractController.php

namespace EOkwukwe\Framework\Controller;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected Request $request;
    protected ?ContainerInterface $container = null;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function render(
        string $template,
        array $parameters = [],
        Response $response = null
    ): Response {
        $content = $this->container->get('twig')->render($template, $parameters);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }
}
