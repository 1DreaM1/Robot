<?php

namespace App\Requests;

use App\Responses\CreateResponse;

class CreateRequest extends Request
{
    const EMAIL = "dakristl123@gmail.com";

    public function url(): string {
        return "create";
    }

    public function method(): string {
        return "POST";
    }

    public function parameters(): array {
        return ["email", self::EMAIL];
    }

    public function responseFactory(int $code, ?object $data = new \stdClass()): CreateResponse  {
        return new CreateResponse($code, $data);
    }
}