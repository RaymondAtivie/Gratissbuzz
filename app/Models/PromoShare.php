<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoShare extends Model
{
    protected $table = "promo_shares";
    protected $guarded = ['id'];

    //RELATIONSHIP
    public function ad()
    {
        return $this->belongsTo("App\Models\Promo");
    }
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
