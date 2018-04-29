<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AssetImageRecord extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'asset_id' => $this->asset_id,
            'image' => $this->image,
            'description' => $this->description,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
