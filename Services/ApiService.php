<?php

namespace App\Services;

use App\Requests\Request;
use App\Responses\Response;
use Exception;
use RestClient;

class ApiService
{
    private RestClient $restClient;

    public function __construct() {
        $this->restClient = new RestClient([
            "base_url" => "https://area51.serverzone.dev/robot",
        ]);
    }

    public function send(Request $request): Response {
        $result = $this->restClient->execute(
            $request->url(),
            $request->method(),
            $request->parameters()
        );

        return $request->responseFactory(
            $result->info->http_code,
            json_decode($result->response)
        );
    }

    /**
     * @throws Exception
     */
    public function trySend(Request $request, int $throttle = 100): Response {
        if ($throttle <= 0) {
            exit("\n>> Robot not responding ! <<\n");
        }

        try {
            return $this->send($request);
        } catch (\Throwable $e) {
            echo "\nERROR >> " . $request::class .">> {$e->getMessage()}";
            return $this->trySend($request, $throttle - 1);
        }
    }
}