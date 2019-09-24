<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'no' => $this->No,
            'Addr1' => $this->Addr1,
            'Addr2' => $this->Addr2,
            'city' => $this->city
        ];
    }
}
