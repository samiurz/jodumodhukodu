<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CustomerBlockModuleActivity extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'contact_id' => $this->contact_id,
            'customer_block_id' => $this->block_id,
            'module_id' => $this->module_id,
            'activity_id' => $this->activity_id,
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
