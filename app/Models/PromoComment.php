<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoComment extends Model
{
    protected $table = "promo_comments";
    protected $guarded = ['id'];

    //RELATIONSHIP
    public function promo()
    {
        return $this->belongsTo("App\Models\Promo");
    }
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
