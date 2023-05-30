<?php

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(BASE_PATH . '/.env');

$container = new \League\Container\Container();

// To enable the use of reflection and apply autowiring
$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';
$templatesPath = BASE_PATH . '/templates';

$appEnv = $_SERVER['APP_ENV'];
$databaseUrl = 'sqlite:///' . BASE_PATH . '/var/db.sqlite';

// Services
$container->add(
    'APP_ENV',
    new \League\Container\Argument\Literal\StringArgument($appEnv)
);

$container->add(
    'base-commands-namespace',
    new \League\Container\Argument\Literal\StringArgument('EOkwukwe\\Framework\\Console\\Command\\')
);

$container->add(
    EOkwukwe\Framework\Routing\RouterInterface::class,
    EOkwukwe\Framework\Routing\Router::class
);

$container->extend(EOkwukwe\Framework\Routing\RouterInterface::class)
    ->addMethodCall(
        'setRoutes',
        [new \League\Container\Argument\Literal\ArrayArgument($routes)]
    );

// $container->add(EOkwukwe\Framework\Http\Kernel::class)
//     ->addArgument(EOkwukwe\Framework\Routing\RouterInterface::class)
//     ->addArgument($container);

$container->add(
    \EOkwukwe\Framework\Http\Middleware\RequestHandlerInterface::class,
    \EOkwukwe\Framework\Http\Middleware\RequestHandler::class
)->addArgument($container);

$container->add(EOkwukwe\Framework\Http\Kernel::class)
    ->addArguments([
        EOkwukwe\Framework\Routing\RouterInterface::class,
        $container,
        \EOkwukwe\Framework\Http\Middleware\RequestHandlerInterface::class
    ]);

$container->addShared(
    \EOkwukwe\Framework\Session\SessionInterface::class,
    \EOkwukwe\Framework\Session\Session::class
);

$container->add(
    'template-renderer-factory',
    \EOkwukwe\Framework\Template\TwigFactory::class
)->addArguments([
    \EOkwukwe\Framework\Session\SessionInterface::class,
    new \League\Container\Argument\Literal\StringArgument($templatesPath)
]);

$container->addShared('twig', function () use ($container) {
    return $container->get('template-renderer-factory')->create();
});

$container->add(\EOkwukwe\Framework\Controller\AbstractController::class);

$container->inflector(\EOkwukwe\Framework\Controller\AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(\EOkwukwe\Framework\Dbal\ConnectionFactory::class)
    ->addArguments([
        new \League\Container\Argument\Literal\StringArgument($databaseUrl)
    ]);

$container->addShared(
    \Doctrine\DBAL\Connection::class,
    function () use ($container): \Doctrine\DBAL\Connection {
        return $container->get(
            \EOkwukwe\Framework\Dbal\ConnectionFactory::class
        )->create();
    }
);

// Console Kernel
$container->add(\EOkwukwe\Framework\Console\Kernel::class)
    ->addArguments([$container, \EOkwukwe\Framework\Console\Application::class]);

$container->add(\EOkwukwe\Framework\Console\Application::class)
    ->addArgument($container);

$container->add(
    'database:migrations:migrate',
    \EOkwukwe\Framework\Console\Command\MigrateDatabase::class
)->addArguments([
    \Doctrine\DBAL\Connection::class,
    new \League\Container\Argument\Literal\StringArgument(BASE_PATH . '/migrations')
]);

$container->add(\EOkwukwe\Framework\Http\Middleware\RouterDispatch::class)
    ->addArguments([
        \EOkwukwe\Framework\Routing\RouterInterface::class,
        $container
    ]);


return $container;
