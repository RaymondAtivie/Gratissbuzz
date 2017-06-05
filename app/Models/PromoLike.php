<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoLike extends Model
{
    protected $table = "promo_likes";
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
