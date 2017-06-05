<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdShare extends Model
{
    protected $table = "ad_shares";
    protected $guarded = ['id'];

    //RELATIONSHIP
    public function ad()
    {
        return $this->belongsTo("App\Models\Ad");
    }
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
