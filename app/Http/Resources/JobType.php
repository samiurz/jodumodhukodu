<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class JobType extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'job_type' => $this->job_type,
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
