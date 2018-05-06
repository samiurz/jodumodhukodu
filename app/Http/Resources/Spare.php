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
            'serial' => $this->serial,
            'type' => $this->type,
            'image' => $this->image,
            'description' => $this->description,
            'manufacturer' => $this->manufacturer,
            'minimum_stock' => $this->minimum_stock,
            'current_stock' => $this->current_stock,
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
