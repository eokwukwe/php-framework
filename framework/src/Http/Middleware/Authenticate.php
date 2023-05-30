<?php

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;

class Authenticate implements MiddlewareInterface
{
    private bool $authenticated = true;

    public function process(
        Request $request,
        RequestHandlerInterface $requestHandler
    ): Response {
        if (!$this->authenticated) {
            return new Response('Authentication failed', 401);
        }

        return $requestHandler->handle($request);
    }
}
