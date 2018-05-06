<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
