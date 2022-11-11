<?php

namespace App\Responses;

use Exception;

class Response
{
    public int $code;

    public object $data = (object)[];

    /**
     * @throws Exception
     */
    public function __construct(int $code, ?object $data = new \stdClass()) {
        $this->code = $code;
        $this->data = $data;

        if ($this->code === 401) {
            throw new Exception("Došla šťava !");
        }

        if (!in_array($this->code, [200, 201])) {
            throw new Exception();
        }
    }

}