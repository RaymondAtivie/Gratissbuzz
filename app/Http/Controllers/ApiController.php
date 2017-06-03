<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\M;
use App\User;
use App\Models\Vendor;
use App\Models\Ad;
use App\Models\Promo;
use App\Models\LiveAd;
use App\Models\LivePromo;
use App\Models\Batch;
use Carbon\Carbon;

class ApiController extends Controller
{
    private $now;
    
    function __construct(){
        $this->now = \Carbon\Carbon::now("Africa/Lagos");
    }

	function getUsers(){
		$users = \App\User::with("vendor")->get();
		
		return response()->json($users, 200);
	}

    function addVendor(Request $request, User $user){
        $post = $request->all();

        $post['image'] = url('assets/images/vendor/unknown.jpg');
        $post['extra_image'] = url('assets/images/vendor/unknown.jpg');
        $newVendor = $user->vendor()->create($post);

		return response()->json($newVendor, 201);        
    }
	
	function getLivePromos(){
		$promos = LivePromo::
            where("begin", "<=", $this->now)
            ->where("end", ">=", $this->now)
            ->orderBy("created_at", "DESC")
            ->with("promo", "promo.vendor", "promo.comments", "promo.comments.user")
            ->get();
		
		return response()->json($promos, 200);
	}

    public function getLivePromosSearch(Request $request){
        $post = $request->all();

        $livePromos = LivePromo::
            where("begin", "<=", $this->now)
            ->where("end", ">=", $this->now)
            ->orderBy("created_at", "DESC")        
            ->with("promo", "promo.vendor", "promo.comments", "promo.comments.user")
            ->get();

        $newPromos = [];
        foreach($livePromos as $lp){
            
            if($post['category'] != "All"){
                if($lp->promo->category != $post['category']){
                    continue;
                }
            }

            if($post['lga'] != "All"){
                if (strpos($lp->promo->location, $post['lga']) === false) {
                    continue;
                }
            }

            if($post['state'] != "All"){
                if (strpos($lp->promo->location, $post['state']) === false) {
                    continue;
                }
            }

            $newPromos[] = $lp;

        }

		return response()->json($newPromos, 200);
    }
	
	function getLiveAds(){
		$ads = LiveAd::
            where("begin", "<=", $this->now)
            ->where("end", ">=", $this->now)
            ->with("ad", "ad.vendor", "question")
            ->get();

        $batches = Batch::
            whereDate("day_begin_date", "<=", $this->now)
            ->whereDate("day_end_date", ">=", $this->now)
            ->with("liveads", "liveads.ad", "liveads.ad.vendor", "liveads.question")
            ->get();            

        $otherAds = collect([]);
        foreach($batches as $batch){
            $otherAds = $otherAds->merge($batch->liveads);
        }

        $payload = [
            "ads"=>$ads,
            "batchAds"=>$otherAds
        ];
		
		return response()->json($payload, 200);
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

    function submitPromo(Request $request, Vendor $vendor){
        $post = $request->all();

        $data = $request->only(['description', 'short_description', 'category', 'location']);
        $start_date = Carbon::parse($post['startDate']);
        $data['approved'] = 1;
        $data['vendor_id'] = $vendor->id;

        $promo = Promo::create($data);
        
        $fakeStart = clone $start_date;
        $endDate = clone $fakeStart->addDays(intval($post['length']));

        $lp = [
            "promo_id" => $promo->id,
            "vendor_id" => $vendor->id,
            "begin" => $start_date,
            "end" => $endDate
        ];

        $livePromo = LivePromo::create($lp);

		return response()->json($promo, 201);        
    }

    function getUserMessages(Request $request, User $user){
        $messages = M::getUserMessages($user->id);

		return response()->json($messages, 201); 
    }

    function getUserMessagesNum(Request $request, User $user){
        $num = M::getUserMessagesNum($user->id);

		return response()->json($num, 201); 
    }

    function readMessage($message){
        $re = M::readMessage($message);

        $output['status'] = $re;

		return response()->json($output, 201);         
    }

    function submitPromoComment(Request $request, Promo $promo){
        $post = $request->all();

        $cu = $promo->comments()->create($post);

        $commentUser = User::find($cu->user_id);
        $cu->user = $commentUser;

        $output = ["status"=>true, "comment"=>$cu];

		return response()->json($output, 201);      
    }

    function getBusinessCategories(){
        $bcs = M::getBusinessCategories();

		return response()->json($bcs, 201);              
    }

    function getStates(){
        $states = M::getStatesArray();

        // $states = ["ikeja"=>["ss", "ssss"]];

		return response()->json($states, 201);              
    }
}
