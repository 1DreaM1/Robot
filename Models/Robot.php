<?php

namespace App\Models;

use App\Enums\Direction;
use App\Requests\CreateRequest;
use App\Requests\EscapeRequest;
use App\Requests\MoveRequest;
use App\Responses\CreateResponse;
use App\Responses\EscapeResponse;
use App\Responses\MoveResponse;
use App\Services\ApiService;
use Exception;

class Robot
{
    public const MAX_DISTANCE = 5;

    private string $id;

    private ApiService $apiService;

    /**
     * @throws Exception
     */
    public function __construct() {
        $this->apiService = new ApiService();

        /** @var CreateResponse $response */
        $response = $this->apiService->send(new CreateRequest());
        $id = $response->getId();

        if (!$id) {
            throw new Exception();
        }

        $this->id = $id;
    }

    public function move(Direction $direction, int $distance): MoveResponse {
        /** @var MoveResponse $response */
        $response = $this->apiService->send(
            new MoveRequest(
                $this->id,
                $direction,
                $distance
            )
        );

        return $response;
    }

    public function escape(int $salary): EscapeResponse {
        /** @var EscapeResponse $response */
        $response = $this->apiService->send(
            new EscapeRequest(
                $this->id,
                $salary
            )
        );

        return $response;
    }

    public function travel(Direction $direction, int $distance): void {
        if ($distance <= 0) {
            return;
        }

        $this->move($direction, $distance);
        $this->travel($direction, $distance - self::MAX_DISTANCE);
    }

    public function getWallDistance(Direction $direction): int {
        $move = $this->move($direction, self::MAX_DISTANCE);
        if ($move->isWall()) {
            return $move->getDistance();
        }

        $movedDistance = $this->getWallDistance($direction);
        $this->move($direction, -self::MAX_DISTANCE);
        return $move->getDistance() + $movedDistance;
    }
}