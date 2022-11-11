<?php

namespace App\Responses;

class CreateResponse extends Response
{
    public function getId(): ?string {
        return $this->data->id;
    }
}