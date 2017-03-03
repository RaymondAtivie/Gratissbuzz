<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsAnswer extends Model
{
    protected $table = "ads_answer";
    protected $guarded = ['id'];
    protected $casts = [
        'correct_status' => 'boolean'
    ];

    	
	//RELATIONSHIP
	public function livead(){
		return $this->belongsTo("App\Models\Ad", "live_ad_id");
	}

}
