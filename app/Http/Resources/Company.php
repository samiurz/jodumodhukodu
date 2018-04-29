<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Company extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'account' => $this->account,
            'company_name' => $this->company_name,
            'is_customer' => $this->is_customer,
            'links' => $this->email,
            'links' => $this->address,
            'update_by' => $this->update_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
