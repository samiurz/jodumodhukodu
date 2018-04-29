<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AssetModel extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'model_type_id' => $this->model_type_id,
            'image' => $this->image,
            'rent' => $this->rent,
            'frequency' => $this->frequency,
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
