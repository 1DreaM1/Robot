<?php

namespace App\Enums;

enum Direction: string
{
    case UP = "up";
    case DOWN = "down";
    case LEFT = "left";
    case RIGHT = "right";

    public function inverted(): self {
        return match ($this) {
            Direction::LEFT => Direction::RIGHT,
            Direction::RIGHT => Direction::LEFT,
            Direction::UP => Direction::DOWN,
            Direction::DOWN => Direction::UP,
        };
    }
}
