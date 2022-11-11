<?php

namespace App\Responses;

use App\Enums\Direction;
use App\Models\Robot;

class MoveResponse extends Response
{
    public Direction $direction;
    public int $distance;

    public function __construct(
        int $code,
        mixed $data,
        Direction $direction,
        int $distance,
    ) {
        parent::__construct($code, $data);

        $this->direction = $direction;
        $this->distance = $distance;
    }

    public function getDistance(): ?int {
        return $this->data->distance;
    }

    public function isWall(): bool {
        return $this->data->distance < abs($this->distance);
    }
}