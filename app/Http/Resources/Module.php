<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Module extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'block' => $this->block,
            'name' => $this->name,
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
