<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Spares extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'asset_id' => $this->asset_id,
            'serial' => $this->serial,
            'type' => $this->type,
            'image' => $this->image,
            'description' => $this->description,
            'manufacturar_id' => $this->manufacturar_id,
            'minimum_stock' => $this->minimum_stock,
            'current_stock' => $this->current_stock,
            'update_by' => $this->update_by   
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
