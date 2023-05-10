<?php

declare(strict_types=1);

use EOkwukwe\Framework\Http\Kernel;
use EOkwukwe\Framework\Http\Request;

define('BASE_PATH', dirname(__DIR__));

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Get the container
$container = require BASE_PATH . '/config/services.php';

// request received
$request = Request::createFromGlobals();

// $router = new Router();
// $kernel = new Kernel($router);
$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);

$response->send();
