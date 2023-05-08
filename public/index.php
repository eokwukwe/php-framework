<?php

declare(strict_types=1);

use EOkwukwe\Framework\Http\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = Request::createFromGlobals();

dd($request);
