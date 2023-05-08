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
            $routeCollector->addRoute('GET', '/', function () {

                $content = '<h1>Hello World</h1>';

                return new Response($content);
            });

            $routeCollector->addRoute('GET', '/posts/{id:\d+}', function ($routeParams) {
                $content = "<h1>This is Post {$routeParams['id']}</h1>";

                return new Response($content);
            });
        });

        $routeInfo = $dispatcher->dispatch(
            httpMethod: $request->server['REQUEST_METHOD'],
            uri: $request->server['REQUEST_URI']
        );

        // Dispatch a URI, to obtain the route info
        [$status, $handler, $routeParams] = $routeInfo;

        // Call the handler, provided by the route info, in order to create a Response
        return $handler($routeParams);
    }
}
