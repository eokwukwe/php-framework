<?php // config/services.php

$container = new \League\Container\Container();

// To enable the use of reflection and apply autowiring
$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';

// Services
$container->add(
    EOkwukwe\Framework\Routing\RouterInterface::class,
    EOkwukwe\Framework\Routing\Router::class
);

$container->extend(EOkwukwe\Framework\Routing\RouterInterface::class)
    ->addMethodCall(
        'setRoutes',
        [new \League\Container\Argument\Literal\ArrayArgument($routes)]
    );

$container->add(EOkwukwe\Framework\Http\Kernel::class)
    ->addArgument(EOkwukwe\Framework\Routing\RouterInterface::class)
    ->addArgument($container);


return $container;
