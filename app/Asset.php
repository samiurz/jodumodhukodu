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
    public function quality(){
        return $this->belongsTo(Quality::class);
    }
    public function assetLocation(){
        return $this->belongsTo(AssetLocation::class);
    }
}
