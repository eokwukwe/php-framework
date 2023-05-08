<?php

namespace EOkwukwe\Framework\Routing;

use EOkwukwe\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request): array;
}
