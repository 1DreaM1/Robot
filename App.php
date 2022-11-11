<?php

namespace App;

use App\Enums\Direction;
use App\Models\Robot;
use Exception;
use Nerd\CartesianProduct\CartesianProduct;

class App
{
    private Robot $robot;

    private const ESTIMATED_SALARY = 100000;

    public function __construct() {
        $this->robot = new Robot();
        print "\nRobot created: id = {$this->robot->id}";
    }

    /**
     * @throws Exception
     */
    public function run(): void {
        $x1 = $this->robot->getWallDistance(Direction::LEFT);
        print "\nX1 = $x1";
        $x2 = $this->robot->getWallDistance(Direction::RIGHT);
        print "\nX2 = $x2";
        $y1 = $this->robot->getWallDistance(Direction::UP);
        print "\nY1 = $y1";
        $y2 = $this->robot->getWallDistance(Direction::DOWN);
        print "\nY2 = $y2";

        $width = $x1 + $x2;
        $height = $y1 + $y2;
        print "\nWIDTH = $width";
        print "\nHEIGHT = $height";

        $widthMids = $this->findMids($width);
        $heightMids = $this->findMids($height);

        $escapeCoords = (new CartesianProduct([
            $widthMids,
            $heightMids
        ]))->compute();

        print "\n";
        print_r($escapeCoords);

        print "\nMID CORDS COUNT >> " . $ec = count($escapeCoords);
        [$x, $y] = $escapeCoords[rand(0, $ec - 1)];

        print "\n>> EJECTING AT [$x, $y] <<";
        $this->robot->travel(Direction::RIGHT, $x - $x1);
        $this->robot->travel(Direction::DOWN, $y - $y1);

        if ($this->robot->escape(self::ESTIMATED_SALARY)->isSuccess()) {
            print "\n\n----------------------------------------";
            print "\n!! SUCCESS !!";
            return;
        }

        print "\n!! CRASH !!\n";
    }

    private function findMids(int $distance): array {
        return array_filter([
            $mid = ceil($distance / 2),
            $distance % 2 == 0 ? $mid + 1 : null
         ]);
    }
}