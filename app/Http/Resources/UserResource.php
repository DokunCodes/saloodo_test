<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'email'     => $this->email,
            'token'     => $this->token,
            'name'  => $this->name,
            'user_type'  => $this->user_type,
            'phone'       => $this->phone,
            'user_id' => $this->id,
            'status' => true
        ];
    }
}
