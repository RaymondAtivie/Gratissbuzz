<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    private $now;
    
    function __construct(){
        $this->now = \Carbon\Carbon::now()->addHour(1);
    }

	function getUsers(){
		$users = \App\User::with("vendor")->get();
		
		return response()->json($users, 200);
	}
	
	function getLivePromos(){
		$promos = \App\Models\LivePromo::
            whereDate("begin", "<=", $this->now)
            ->whereDate("end", ">=", $this->now)
            ->with("promo", "promo.vendor", "promo.comments", "promo.comments.user")
            ->get();
		
		return response()->json($promos, 200);
	}
	
	function getLiveAds(){
        // print_r($this->now);
        // echo $this->now;
		$ads = \App\Models\LiveAd::
            whereDate("begin", "<=", $this->now)
            ->whereDate("end", ">=", $this->now)
            ->with("ad", "ad.vendor", "question")
            ->get();
		
		return response()->json($ads, 200);
	}
	
	function getStandardAds(){
        $sAds = [];
		$sAds = \App\Models\StandardAd::
            whereDate("begin", "<=", $this->now)
            ->whereDate("end", ">=", $this->now)
            ->get();
		
		return response()->json($sAds, 200);
	}
}
