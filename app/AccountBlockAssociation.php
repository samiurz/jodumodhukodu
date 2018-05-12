<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountBlockAssociation extends Model
{
    public function account(){
        return $this->belongsTo(Account::class);
    }
    public function block(){
        return $this->belongsTo(Block::class);
    }
    public function blockStat(){
        return $this->belongsTo(BlockStat::class);
    }
}
