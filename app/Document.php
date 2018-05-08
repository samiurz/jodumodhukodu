<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function documentationType(){
        return $this->belongsTo(DocumentationType::class);
    }
}
