<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBlockModuleAction extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'contact' => $this->contact,
            'block' => $this->block,
            'module' => $this->module,
            'activity' => $this->activity,
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
