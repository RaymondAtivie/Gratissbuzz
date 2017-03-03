<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivePromo extends Model
{
	protected $table = 'live_promos';
	protected $guarded = ['id'];
	protected $dates = ['begin', 'end'];
	
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
	
	#RELATIONSHIPS
	public function promo(){
		return $this->belongsTo("App\Models\Promo");
	}
	
}
