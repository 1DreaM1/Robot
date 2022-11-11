<?php

namespace App\Requests;

use App\Responses\CreateResponse;
use Exception;

class CreateRequest extends Request
{
    private const EMAIL = "dakristl123@gmail.com";

    public function method(): string {
        return "POST";
    }

    public function parameters(): array {
        return ["email" => self::EMAIL];
    }

    /**
     * @throws Exception
     */
    public function responseFactory(int $code, mixed $data): CreateResponse  {
        return new CreateResponse($code, $data);
    }
}