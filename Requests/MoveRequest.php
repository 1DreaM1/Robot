<?php

namespace App\Requests;

use App\Enums\Direction;
use App\Responses\MoveResponse;
use Exception;

class MoveRequest extends Request
{
    private string $id;
    private Direction $direction;
    private int $distance;

    /**
     * @throws Exception
     */
    public function __construct(string $id, Direction $direction, int $distance) {
        $this->id = $id;
        $this->direction = $direction;
        $this->distance = $distance;

        if ($this->distance <= 0) {
            throw new Exception("ERROR >> distance <= 0 !", 500);
        }
    }

    public function url(): string {
        return  $this->id ."/move";
    }

    public function method(): string {
        return "PUT";
    }

    public function parameters(): array {
        return [
            "direction" => $this->direction->value,
            "distance" => $this->distance
        ];
    }

    /**
     * @throws Exception
     */
    public function responseFactory(int $code, mixed $data): MoveResponse  {
        return new MoveResponse($code, $data, $this->direction, $this->distance);
    }
}