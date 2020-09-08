<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function skillOwner(){
        return $this->belongsTo(User::class);
    }
}
