<?php

namespace App\Requests;

use App\Responses\EscapeResponse;
use Exception;

class EscapeRequest extends Request
{
    private string $id;

    private int $salary;

    public function __construct(string $id, int $salary) {
        $this->id = $id;
        $this->salary = $salary;
    }

    public function url(): string {
        return $this->id ."/escape";
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

    /**
     * @throws Exception
     */
    public function responseFactory(int $code, mixed $data): EscapeResponse  {
        return new EscapeResponse($code, $data);
    }
}