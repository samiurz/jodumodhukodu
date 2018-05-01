<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Account extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'comments' => $this->comments,
            'update_by' => $this->update_by
            
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
