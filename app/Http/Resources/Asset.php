<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Asset extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'model_id' => $this->model_id,
            'name' => $this->name,
            'label_id' => $this->label_id,
            'label_value' => $this->label_value,
            'description' => $this->description,
            'quality' => $this->quality,
            'status' => $this->status,
            'cost' => $this->cost,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
