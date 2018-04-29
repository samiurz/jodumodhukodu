<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AccountBlockAssociation extends Resource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'block_id' => $this->block_id,
            'block_stat_id' => $this->block_stat_id,
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
