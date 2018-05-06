<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentationType extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
