<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Vendor extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function ads()
    {
        return $this->hasMany("App\Models\Ad");
    }
    public function promos()
    {
        return $this->hasMany("App\Models\Ad");
    }
    public function liveads()
    {
        return $this->hasMany("App\Models\LiveAd");
    }
    public function livepromos()
    {
        return $this->hasMany("App\Models\LivePromo");
    }
    
}