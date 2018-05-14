<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairType extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
