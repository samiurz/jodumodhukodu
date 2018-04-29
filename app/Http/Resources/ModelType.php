<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ModelType extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'account_id' => $this->company_id,
            'make' => $this->make,
            'type' => $this->type,
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
