<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'image', 'location', 'status', 'gender', 'username', 'referal', 'refered', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships
    public function vendor()
    {
        return $this->hasMany("App\Models\Vendor");
    }

    public function referedUser(){
        return $this->hasOne("App\User", "id", "refered");
    }
}
