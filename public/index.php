<?php

declare(strict_types=1);

use EOkwukwe\Framework\Http\Kernel;
use EOkwukwe\Framework\Http\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$kernel = new Kernel();

// send response (string of content)
$response = $kernel->handle($request);

$response->send();
