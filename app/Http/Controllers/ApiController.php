<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Vendor;
use App\Models\Ad;
use App\Models\Promo;
use App\Models\LiveAd;
use App\Models\LivePromo;

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

    function getVendorsAds(Vendor $vendor){
        $ads = $vendor->ads;

		return response()->json($ads, 200);
    }
    function getVendorsLiveAds(Vendor $vendor){
        $ads = $vendor->liveads;

        $liveads = [];
        foreach($ads as $ad){
            $liveads[] = LiveAd::with(['ad', 'question'])->find($ad->id);
        }

		return response()->json($liveads, 200);
    }

    function getVendorsPromos(Vendor $vendor){
        $promos = $vendor->promos;

		return response()->json($promos, 200);
    }
    function getVendorsLivePromos(Vendor $vendor){
        $promos = $vendor->livepromos;

        $livepromos = [];
        foreach($promos as $promo){
            $livepromos[] = LivePromo::with(['promo'])->find($promo->id);
        }

		return response()->json($livepromos, 200);
    }

    function submitAd(Request $request, Vendor $vendor){
        $post = $request->all();

        $post['vendor_id'] = $vendor->id;
        $ad = Ad::create($post);

		return response()->json($ad, 201);        
    }
}
