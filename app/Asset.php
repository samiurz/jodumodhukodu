<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function assetModel(){
        return $this->belongsTo(AssetModel::class);
    }
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }
}
