<?php

use EOkwukwe\Framework\Http\Response;

return [
    ['GET', '/', function () {

        $content = '<h1>Hello World</h1>';

        return new Response($content);
    }]
];
