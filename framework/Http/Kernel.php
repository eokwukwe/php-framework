<?php

namespace EOkwukwe\Framework\Http;

use Exception;
use EOkwukwe\Framework\Routing\Router;

class Kernel
{
    public function __construct(
        private Router $router
    ) {
    }

    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $routeParams] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $routeParams);
        } catch (Exception $e) {
            $response = new Response($e->getMessage(), 400);
        }

        return $response;
    }
}
