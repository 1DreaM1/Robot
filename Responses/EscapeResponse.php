<?php

namespace App\Responses;

class EscapeResponse extends Response
{
    public function isSuccess(): bool {
        return $this->data->success == true;
    }
}