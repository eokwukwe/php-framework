<?php

namespace EOkwukwe\Framework\Http;

class Request
{
    public function __construct(
        public readonly array $getParams,
        public readonly array $postParams,
        public readonly array $cookies,
        public readonly array $files,
        public readonly array $server
    ) {
    }

    public static function createFromGlobals(): static
    {
        return new static(
            getParams: $_GET,
            postParams: $_POST,
            cookies: $_COOKIE,
            files: $_FILES,
            server: $_SERVER
        );
    }
}
