<?php

namespace App;

use App\Enums\Direction;
use App\Helpers\Cartesian;
use App\Models\Robot;

class App
{
    private Robot $robot;

    private const ESTIMATED_SALARY = 100000;

    public function __construct() {
        $this->robot = new Robot();
    }

    public function run(): void {
        $x1 = $this->robot->getWallDistance(Direction::LEFT);
        $x2 = $this->robot->getWallDistance(Direction::RIGHT);
        $y1 = $this->robot->getWallDistance(Direction::UP);
        $y2 = $this->robot->getWallDistance(Direction::DOWN);

        $width = $x1 + $x2;
        $height = $y1 + $y2;

        $widthMids = $this->findMids($width);
        $heightMids = $this->findMids($height);

        $escapeCoords = array_unique(
            Cartesian::build([$widthMids, $heightMids])
        );

        foreach ($escapeCoords as [$x, $y]) {
            $this->robot->travel(Direction::RIGHT, $x - $x1);
            $this->robot->travel(Direction::DOWN, $y - $y1);

            if ($this->robot->escape(self::ESTIMATED_SALARY)->isSuccess()) {
                return;
            }
        }
    }

    private function findMids(int $distance): array {
        return array_filter([
            $mid = ceil($distance / 2),
            $distance % 2 == 0 ? $mid + 1 : null
         ]);
    }

}