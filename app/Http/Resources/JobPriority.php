<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class JobPriority extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company' => $this->company,
            'priority' => $this->priority,
            'comments' => $this->comments,
            'is_enabled'=>$this->is_enabled,
            'created_by' => $this->created_by,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
