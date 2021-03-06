<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'approved' => 'boolean',        
        'sharable' => 'boolean',
        'image' => 'array'
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
        return $this->hasMany("App\Models\PromoComment")->orderBy('created_at', "DESC");
    }

    public function likes()
    {
        return $this->hasMany("App\Models\PromoLike")->orderBy('created_at', "DESC");
    }

    public function shares()
    {
        return $this->hasMany("App\Models\PromoShare")->orderBy('created_at', "DESC");
    }
}
