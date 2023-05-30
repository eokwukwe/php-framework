<?php

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;

interface MiddlewareInterface
{
    public function process(
        Request $request,
        RequestHandlerInterface $requestHandler
    ): Response;
}
