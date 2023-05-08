<?php

namespace EOkwukwe\Framework\Http;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {

        // Create a dispatcher
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            httpMethod: $request->getMethod(),
            uri: $request->getPathInfo()
        );

        // Dispatch a URI, to obtain the route info
        [$status, [$controller, $method], $routeParams] = $routeInfo;

        // Call the handler, provided by the route info, in order to create a Response
        $response = call_user_func_array([new $controller, $method], $routeParams);

        return $response;
    }
}
