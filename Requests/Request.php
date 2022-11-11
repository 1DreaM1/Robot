<?php

namespace App\Requests;

abstract class Request
{
    public function url(): string {
        return "/";
    }

    abstract public function method(): string;

    abstract public function parameters(): array;

    abstract public function responseFactory(int $code, mixed $data): mixed;

}