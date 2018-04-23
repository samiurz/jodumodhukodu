<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Activity extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'activity_name' => $this->activity_name,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
