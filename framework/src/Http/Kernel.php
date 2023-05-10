<?php

namespace EOkwukwe\Framework\Http;

use Exception;
use EOkwukwe\Framework\Routing\Router;
use EOkwukwe\Framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;

class Kernel
{
    public function __construct(
        private RouterInterface $router,
        private ContainerInterface $container
    ) {
    }

    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $routeParams] = $this->router->dispatch(
                $request,
                $this->container
            );

            $response = call_user_func_array($routeHandler, $routeParams);
        } catch (HttpException $e) {
            $response = new Response(
                $e->getMessage(),
                $e->getStatusCode()
            );
        }
        // catch (Exception $e) {
        //     $response = new Response($e->getMessage(), 500);
        // }

        return $response;
    }
}