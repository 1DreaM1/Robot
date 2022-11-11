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

    public string $id;

    private ApiService $apiService;

    /**
     * @throws Exception
     */
    public function __construct() {
        $this->apiService = new ApiService();

        /** @var CreateResponse $response */
        $response = $this->apiService->trySend(new CreateRequest());
        $id = $response->getId();

        if (!$id) {
            throw new Exception();
        }

        $this->id = $id;
    }

    /**
     * @throws Exception
     */
    public function move(Direction $direction, int $distance): MoveResponse {
        /** @var MoveResponse $response */
        $response = $this->apiService->trySend(
            new MoveRequest(
                $this->id,
                $direction,
                $distance
            )
        );

        return $response;
    }

    /**
     * @throws Exception
     */
    public function escape(int $salary): EscapeResponse {
        /** @var EscapeResponse $response */
        $response = $this->apiService->trySend(
            new EscapeRequest(
                $this->id,
                $salary
            )
        );

        return $response;
    }

    /**
     * @throws Exception
     */
    public function travel(Direction $direction, int $distance): void {
        if ($distance <= 0) {
            return;
        }

        $this->move($direction, $distance);
        $this->travel($direction, $distance - self::MAX_DISTANCE);
    }

    /**
     * @throws Exception
     */
    public function getWallDistance(Direction $direction): int {
        $move = $this->move($direction, self::MAX_DISTANCE);
        $distance = $move->getDistance();
        if ($move->isWall()) {
            if ($distance != 0) {
                $this->move($direction->inverted(), $distance);
            }

            return $distance;
        }

        $movedDistance = $this->getWallDistance($direction);

        $this->move($direction->inverted(), self::MAX_DISTANCE);
        echo "\nMoved distance = " . $distance + $movedDistance;
        return $distance + $movedDistance;
    }
}