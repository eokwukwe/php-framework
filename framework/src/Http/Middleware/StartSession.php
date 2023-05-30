<?php

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;
use EOkwukwe\Framework\Session\SessionInterface;

class StartSession implements MiddlewareInterface
{
    public function __construct(private SessionInterface $session)
    {
    }

    public function process(
        Request $request,
        RequestHandlerInterface $requestHandler
    ): Response {
        $this->session->start();

        $request->setSession($this->session);

        return $requestHandler->handle($request);
    }
}
