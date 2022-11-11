<?php

namespace App\Responses;

use Exception;

class Response
{
    public int $code;

    public mixed $data;

    /**
     * @throws Exception
     */
    public function __construct(int $code, mixed $data) {
        $this->code = $code;
        $this->data = $data;

        if ($this->code === 410) {
            exit("\nDošla šťava !\n");
        }

        if (!in_array($this->code, [200, 201])) {
            throw new Exception("Chyba komunikácie !", $this->code);
        }
    }

}