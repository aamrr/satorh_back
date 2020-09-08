<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userTrainings(){
        return $this->hasMany(Training::class);
    }

    public function userLeaves(){
        return $this->hasMany(Leave::class);
    }

    public function userEvaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function userSkills(){
        return $this->hasMany(Skill::class);
    }

    public function supervisor(){
        return $this.belongsTo(User::class);
    }

    public function supervising(){
        return $this.hasMany(User::class);
    }

    public function responsibleFor(){
        return $this.hasMany(Evaluation::class);
    }
}
