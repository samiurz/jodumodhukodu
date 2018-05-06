<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }
    public function asset(){
        return $this->belongsTo(Asset::class);
    }
}
