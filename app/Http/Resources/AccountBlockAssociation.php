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
            'account' => $this->account,
            'block' => $this->block,
            'blockStat' => $this->blockStat,
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
