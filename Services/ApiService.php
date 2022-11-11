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
            "base_url" => "https://area51.serverzone.dev"
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
            $result->response
        );
    }

    /**
     * @throws Exception
     */
    public function trySend(Request $request): ?Response {
        try {
            return $this->send($request);
        } catch (\Throwable $e) {
            return null;
        }
    }
}