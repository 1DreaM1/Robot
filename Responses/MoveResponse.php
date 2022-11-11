<?php

namespace App\Responses;

use App\Enums\Direction;

class MoveResponse extends Response
{
    public Direction $direction;
    public int $distance;

    public function __construct(
        int $code,
        Direction $direction,
        int $distance,
        ?object $data = new \stdClass(),
    ) {
        parent::__construct($code, $data);

        $this->direction = $direction;
        $this->distance = $distance;
    }

    public function getDistance(): ?int {
        return $this->data->distance;
    }

    public function isWall(): bool {
        return $this->data->distance < $this->distance || $this->data->distance == 0;
    }
}