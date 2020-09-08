<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function responsible(){
        return $this.belongsTo(User::class);
    }

    public function evaluationOwner(){
        return $this.belongsTo(User::class);
    }
}
