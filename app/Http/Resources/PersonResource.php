<?php

namespace App\Http\Resources;

use App\Http\Requests\PersonRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
