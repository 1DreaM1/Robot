<?php

namespace App\Requests;

use App\Responses\EscapeResponse;

class EscapeRequest extends Request
{
    private string $id;

    private int $salary;

    public function __construct(string $id, int $salary) {
        $this->id = $id;
        $this->salary = $salary;
    }

    public function url(): string {
        return "escape";
    }

    public function method(): string {
        return "PUT";
    }

    public function parameters(): array {
        return [
            "id" => $this->id,
            "salary" => $this->salary
        ];
    }

    public function responseFactory(int $code, ?object $data = new \stdClass()): EscapeResponse  {
        return new EscapeResponse($code, $data);
    }
}