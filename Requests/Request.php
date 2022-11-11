<?php

namespace App\Requests;

abstract class Request
{
    abstract public function url(): string;

    abstract public function method(): string;

    abstract public function parameters(): array;

    abstract public function responseFactory(int $code, ?object $data = new \stdClass()): mixed;

}