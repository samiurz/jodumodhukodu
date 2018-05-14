<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Spare extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company' => $this->company,
            'asset' => $this->asset,
            'name' => $this->name,
            'serial' => $this->serial,
            'cost' => $this->cost,
            'image' => $this->image,
            'description' => $this->description,
            'manufacturer' => $this->manufacturer,
            'minimum_stock' => $this->minimum_stock,
            'current_stock' => $this->current_stock,
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
