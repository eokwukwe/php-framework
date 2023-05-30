<?php

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;
use Psr\Container\ContainerInterface;

class RequestHandler implements RequestHandlerInterface
{
    private array $middlewares = [
        Authenticate::class,
        RouterDispatch::class
    ];

    public function __construct(private ContainerInterface $container)
    {
    }

    public function handle(Request $request): Response
    {
        // If there are no middleware classes to execute, return a default response
        // A response should have been returned before the list becomes empty
        if (empty($this->middlewares)) {
            return new Response("It's totally borked, mate. Contact support", 500);
        }

        // Get the next middleware class to execute
        $middlewareClass = array_shift($this->middlewares);

        // Create a new instance of the middleware from the container
        $middleware = $this->container->get($middlewareClass);

        // call process on it
        $response = $middleware->process($request, $this);

        return $response;
    }
}
