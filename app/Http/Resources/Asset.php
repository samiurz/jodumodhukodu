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
            'model' => $this->model,
            'name' => $this->name,
            'name' => $this->serial,
            'type' => $this->type,
            'label_id' => $this->label_id,
            'label_value' => $this->label_value,
            'description' => $this->description,
            'quality' => $this->quality,
            'cost' => $this->cost,
            'status' => $this->status,
            'image' => $this->image,
            'current_stock' => $this->current_stock,
            'minimum_stock' => $this->minimum_stock,
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
