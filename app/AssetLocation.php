<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetLocation extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
