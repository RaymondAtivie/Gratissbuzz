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
    
}