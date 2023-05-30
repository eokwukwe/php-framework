<?php

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;
use EOkwukwe\Framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;

class RouterDispatch implements MiddlewareInterface
{
    public function __construct(
        private RouterInterface $router,
        private ContainerInterface $container
    ) {
    }

    public function process(
        Request $request,
        RequestHandlerInterface $requestHandler
    ): Response {
        [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);

        $response = call_user_func_array($routeHandler, $vars);

        return $response;
    }
}
