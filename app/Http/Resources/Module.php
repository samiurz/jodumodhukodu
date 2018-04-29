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
            'block_id' => $this->block_id,
            'name' => $this->name,
            'comment' => $this->comment,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
