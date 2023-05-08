<?php

namespace EOkwukwe\Framework\Routing;

use FastRoute\RouteCollector;
use EOkwukwe\Framework\Http\Request;

use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array
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

        return [[new $controller, $method], $routeParams];
    }
}
