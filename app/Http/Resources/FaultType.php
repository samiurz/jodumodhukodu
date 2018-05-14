<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FaultType extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company' => $this->company,
            'asset_id' => $this->asset_id,
            'type' => $this->type,
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
