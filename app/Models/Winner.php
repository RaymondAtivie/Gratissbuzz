<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = "winners";
    protected $guarded = ["id"];

    public function user(){
		return $this->belongsTo("App\User");
	}
	
	public function livead(){
		return $this->belongsTo("App\Models\LiveAd", "live_ad_id");
	}
	
	public function answer(){
		return $this->belongsTo("App\Models\AdsAnswer", "ads_answer_id");
	}

}
