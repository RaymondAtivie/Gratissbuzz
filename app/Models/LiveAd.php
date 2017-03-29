<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveAd extends Model
{
	protected $table = 'live_ads';
	protected $guarded = ['id'];
	protected $dates = ['begin', 'end', 'question_begin'];

	public function isLive(){
		$now = \Carbon\Carbon::now();

		// echo $this->id;
		// dd($this->begin->lte($now));

		if($this->begin->lte($now) && $this->end->gte($now)){
			return true;
		}else{
			return false;
		}
	}
	
	//RELATIONSHIP
    public function question(){
		return $this->belongsTo("App\Models\Question");
	}
	
	public function ad(){
		return $this->belongsTo("App\Models\Ad");
	}
	
	public function vendor(){
		return $this->belongsTo("App\Models\Vendor");
	}
}
