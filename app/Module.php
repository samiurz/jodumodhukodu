<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function block(){
        return $this->belongsTo(Block::class);
    }
}
