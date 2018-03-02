<?php

namespace App\Http\Resources\API\Cnr;

use Illuminate\Http\Resources\Json\Resource;

class UserBalanceResource extends Resource
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
            'user_id' => $this->user_id,
            'phone_number' => $this->phone_number,
            'balance' => $this->balance->amount,
            'created_at' => $this->balance->created_at,
            'updated_at' => $this->balance->updated_at,
        ];
    }
}
