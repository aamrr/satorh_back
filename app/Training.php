<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function trainingOwner(){
        return $this->belongsTo(User::class);
    }
}
