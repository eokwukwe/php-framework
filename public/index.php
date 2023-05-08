<?php

declare(strict_types=1);

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$content = '<h1>Hello, World!</h1>';

$response = new Response(content: $content);

$response->send();
