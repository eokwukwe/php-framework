<?php 

namespace EOkwukwe\Framework\Http\Middleware;

use EOkwukwe\Framework\Http\Request;
use EOkwukwe\Framework\Http\Response;

interface RequestHandlerInterface
{
    public function handle(Request $request): Response;
}
