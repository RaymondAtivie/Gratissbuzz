<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'approved' => 'boolean'
    ];    

    public function scopeApproved($query, $type=1){
        if($type == false){
            $type = 0;
        }else{
            $type = 1;
        }
        return $query->where("approved", $type);
    }

    //RELATIONSHIP
    public function vendor()
    {
        return $this->belongsTo("App\Models\Vendor");
    }

    public function comments()
    {
        return $this->hasMany("App\Models\PromoComment");
    }
}
