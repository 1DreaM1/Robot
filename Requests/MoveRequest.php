<?php

namespace App\Requests;

use App\Enums\Direction;
use App\Responses\MoveResponse;

class MoveRequest extends Request
{
    private string $id;
    private Direction $direction;
    private int $distance;

    public function __construct(string $id, Direction $direction, int $distance) {
        $this->id = $id;
        $this->direction = $direction;
        $this->distance = $distance;
    }

    public function url(): string {
        return "move";
    }

    public function method(): string {
        return "PUT";
    }

    public function parameters(): array {
        return [
            "id" => $this->id,
            "direction" => $this->direction->value,
            "distance" => $this->distance
        ];
    }

    public function responseFactory(int $code, ?object $data = new \stdClass()): MoveResponse  {
        return new MoveResponse($code, $this->direction, $this->distance , $data);
    }
}