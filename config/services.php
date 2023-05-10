<?php // config/services.php

$container = new \League\Container\Container();

$container->add(
    EOkwukwe\Framework\Routing\RouterInterface::class,
    EOkwukwe\Framework\Routing\Router::class
);

$container->add(EOkwukwe\Framework\Http\Kernel::class)
    ->addArgument(EOkwukwe\Framework\Routing\RouterInterface::class);

return $container;
