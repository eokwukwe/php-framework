<?php

namespace EOkwukwe\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\HttpException;
use EOkwukwe\Framework\Http\HttpRequestMethodException;

use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array
    {
        // Dispatch a URI, to obtain the route info
        [$handler, $routeParams] = $this->extractRouteInfo($request);

        if (!is_array($handler)) {
            return [$handler, $routeParams];
        }

        [$controller, $method] = $handler;

        return [[new $controller, $method], $routeParams];
    }

    private function extractRouteInfo(Request $request): array
    {
        // Create a dispatcher
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {

            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        // Dispatch a URI, to obtain the route info
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPathInfo()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]]; // [routeHandler, vars]
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);

                $e = new HttpRequestMethodException(
                    "The allowed methods are $allowedMethods"
                );

                $e->setStatusCode(405);
                throw $e;
            default:
                $e = new HttpException('Not found');
                $e->setStatusCode(404);
                throw $e;
        }
    }
}
