<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\M;
use App\User;
use App\Models\Vendor;
use App\Models\Ad;
use App\Models\AdsAnswer;
use App\Models\Promo;
use App\Models\LiveAd;
use App\Models\LivePromo;
use App\Models\Batch;
use App\Models\Content;
use Carbon\Carbon;

use Image;

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

		$save_path = "upload_ads/";
        $filename = rand(1000,9999999).time().".jpg";

        $img = Image::make($post['image']);
        $img->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })
            ->crop(150, 150)
        	->save($save_path.$filename);
		
		$post['image'] = url($save_path.$filename);
		// $post['extra_image'] = url('assets/images/vendor/unknown.jpg');
		$newVendor = $user->vendor()->create($post);
		
		return response()->json($newVendor, 201);
	}
	
	function getLivePromos(){
		$promos = LivePromo::
		            where("begin", "<=", $this->now)
		            ->where("end", ">=", $this->now)
		            ->orderBy("created_at", "DESC")
		            ->with("promo.vendor", "promo.comments.user", "promo.likes.user", "promo.shares.user")
					->get();
		
		return response()->json($promos, 200);
	}
	
	public function getLivePromosSearch(Request $request){
		$post = $request->all();
		
		$livePromos = LivePromo::
		            where("begin", "<=", $this->now)
		            ->where("end", ">=", $this->now)
		            ->orderBy("created_at", "DESC")        
		            ->with("promo.vendor", "promo.comments.user", "promo.likes.user", "promo.shares.user")
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
	
	public function getLiveAdsSearch(Request $request){
		$post = $request->all();
		
		$ads = LiveAd::
		            where("begin", "<=", $this->now)
		            ->where("end", ">=", $this->now)
		            ->with(
		                "ad.vendor", "question", 
		                "ad.comments.user", 
		                "ad.shares.user", 
		                "ad.likes.user"
		            )
		            ->get();
		
		$batches = Batch::
		            where("day_begin_date", "<=", $this->now->copy()->endOfDay())
		            ->where("day_end_date", ">=", $this->now->copy()->startOfDay())
		            ->with(
		                "liveads.ad.vendor", "liveads.question", 
		                "liveads.ad.comments.user", 
		                "liveads.ad.likes.user",
		                "liveads.ad.shares.user"
		            )
		            ->get();
		
		$otherAds = collect([]);
		foreach($batches as $batch){
			$otherAds = $otherAds->merge($batch->liveads);
		}
		
		$newAds = [];
		foreach($otherAds as $la){
			
			if($post['category'] != "All"){
				if($la->ad->category != $post['category']){
					continue;
				}
			}
			
			if($post['lga'] != "All"){
				if (strpos($la->ad->location, $post['lga']) === false) {
					continue;
				}
			}
			
			if($post['state'] != "All"){
				if (strpos($la->ad->location, $post['state']) === false) {
					continue;
				}
			}
			
			$newAds[] = $la;
			
		}
		
		return response()->json($newAds, 200);
	}
	
	function getLiveAds(){
		$ads = LiveAd::
		            where("begin", "<=", $this->now)
		            ->where("end", ">=", $this->now)
		            ->with(
		                "ad.vendor", "question", 
		                "ad.comments.user", 
		                "ad.shares.user", 
		                "ad.likes.user"
		            )
		            ->get();
		
		$batches = Batch::
		            where("day_begin_date", "<=", $this->now->copy()->endOfDay())
		            ->where("day_end_date", ">=", $this->now->copy()->startOfDay())
		            ->with(
		                "liveads.ad.vendor", "liveads.question", 
		                "liveads.ad.comments.user", 
		                "liveads.ad.likes.user",
		                "liveads.ad.shares.user"
		            )
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

        $save_path = "upload_ads/";
		
		$images = [];
		foreach($post['newImages'] as $newImage){
			$filename = rand(1000,9999999).time().".jpg";

			$img = Image::make($newImage);
			$img->resize(550, null, function ($constraint) { $constraint->aspectRatio(); })
				->save($save_path.$filename);
			$images[] = url($save_path.$filename);
		}
		
		$data = $request->only(['description', 'incentive_amt', 'incentive', 'selection_method']);
		$data['vendor_id'] = $vendor->id;
		$data['image'] = $images;
		$ad = Ad::create($data);
		
		$text = "Thank you for using GratisBuzz your advert is being processed";
		M::sendEmail($vendor->user->email, $vendor->user->name, "Advert Submitted", $text);
		M::sendMessage("Advert Submitted", $text, "info", $vendor->user->id);
		
		return response()->json($ad, 201);
	}
	
	function submitPromo(Request $request, Vendor $vendor){
		$post = $request->all();

		$save_path = "upload_ads/";
		
		$images = [];
		foreach($post['newImages'] as $newImage){
			$filename = rand(1000,9999999).time().".jpg";

			$img = Image::make($newImage);
			$img->resize(550, null, function ($constraint) { $constraint->aspectRatio(); })
				->save($save_path.$filename);
			$images[] = url($save_path.$filename);
		}
		
		$data = $request->only(['description', 'short_description', 'category', 'location']);
		$start_date = Carbon::parse($post['startDate']);
		$data['approved'] = 1;
		$data['vendor_id'] = $vendor->id;
		$data['image'] = $images;
		
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
		
		$text = "Thank you for using GratisBuzz Promotion’s Awareness platform, kindly visit the Promotion page to view your advert";
		M::sendEmail($vendor->user->email, $vendor->user->name, "Promotion Submitted", $text);
		M::sendMessage("Promotion Submitted", $text, "info", $vendor->user->id);
		
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
	
	function submitPromoLike(Request $request, Promo $promo){
		$post = $request->all();
		
		$cu = $promo->likes()->create($post);
		
		$likeUser = User::find($cu->user_id);
		$cu->user = $likeUser;
		
		$output = ["status"=>true, "like"=>$cu];
		
		return response()->json($output, 201);
	}
	
	function submitPromoShare(Request $request, Promo $promo){
		$post = $request->all();
		
		$cu = $promo->shares()->create($post);
		
		$likeUser = User::find($cu->user_id);
		$cu->user = $likeUser;
		
		$output = ["status"=>true, "like"=>$cu];
		
		return response()->json($output, 201);
	}
	
	function submitAdComment(Request $request, Ad $ad){
		$post = $request->all();
		
		$cu = $ad->comments()->create($post);
		
		$commentUser = User::find($cu->user_id);
		$cu->user = $commentUser;
		
		$output = ["status"=>true, "comment"=>$cu];
		
		return response()->json($output, 201);
	}
	
	function submitAdLike(Request $request, Ad $ad){
		$post = $request->all();
		
		$cu = $ad->likes()->create($post);
		
		$likeUser = User::find($cu->user_id);
		$cu->user = $likeUser;
		
		$output = ["status"=>true, "like"=>$cu];
		
		return response()->json($output, 201);
	}
	
	function submitAdShare(Request $request, Ad $ad){
		$post = $request->all();
		
		$cu = $ad->shares()->create($post);
		
		$likeUser = User::find($cu->user_id);
		$cu->user = $likeUser;
		
		$output = ["status"=>true, "like"=>$cu];
		
		return response()->json($output, 201);
	}
	
	function checkAdLike(Request $request, Ad $ad){
		$post = $request->all();
		
		$liked = $ad->likes()->where(['user_id' => $post['user_id']])->first();
		
		if($liked){
			$output = ["status"=>true, "liked"=>true];
		}
		else{
			$output = ["status"=>true, "liked"=>false];
		}
		
		return response()->json($output, 201);
	}
	
	function checkPromoLike(Request $request, Promo $promo){
		$post = $request->all();
		
		$liked = $promo->likes()->where(['user_id' => $post['user_id']])->first();
		
		if($liked){
			$output = ["status"=>true, "liked"=>true];
		}
		else{
			$output = ["status"=>true, "liked"=>false];
		}
		
		return response()->json($output, 201);
	}
	
	function getBusinessCategories(){
		$bcs = M::getBusinessCategories();
		
		$allBcs = [];
		foreach($bcs as $b){
			$allBcs[] = $b->name;
		}
		
		return response()->json($allBcs, 201);
	}
	
	function getStates(){
		$states = M::getStatesArray();
		
		return response()->json($states, 201);
	}
	
	function getContent($content_name){
		$content = Content::where(['name'=>$content_name])->first();
		
		$data = [
            "success"=>"true",
            "message"=>"$content_name content retrieved",
            "data" => $content
        ];
		
		return response()->json($data, 201);
	}
	
	function answerQuestion(Request $request, LiveAd $livead){
		$post = $request->only(['user_id', 'answer']);
		
		$AdsAnswers = AdsAnswer::where(["user_id"=>$post['user_id'], "live_ad_id"=>$livead->id])->get();
		
		if(count($AdsAnswers) > 0){
			$data = [
                "success"=>"false",
                "message"=>"You have already answered this question"
            ];
		}
		else{
			$aa = new AdsAnswer();
			$aa->user_id = $post['user_id'];
			$aa->live_ad_id = $livead->id;
			$aa->answer = $post['answer'];
			if($aa->answer == $livead->question->answer){
				$aa->correct_status = true;
			}
			else{
				$aa->correct_status = false;
			}
			$aa->save();
			
			$data = [
                "success"=>"true",
                "message"=>"your answer has been submitted",
                "data" => $aa
            ];
		}
		
		
		return response()->json($data, 201);
	}
	
	function isQuestionAnswered(Request $request, LiveAd $livead){
		$post = $request->only(['user_id']);
		
		$AdsAnswers = AdsAnswer::where(["user_id"=>$post['user_id'], "live_ad_id"=>$livead->id])->get();
		
		if(count($AdsAnswers) > 0){
			$d = true;
		}
		else{
			$d =false;
		}
		
		$data = [
            "success"=>true,
            "data"=>$d
        ];
		
		return response()->json($data, 201);
	}

	function contactUs(Request $req, $user_id){
		$user = User::find($user_id);

		$message = $req->message;

		$text = "<b>".$user->name."</b> with email <b>".$user->email."</b> said: <hr />";
		$text .= $message;

		$email_to = "RaymondAtivie@gmail.com";
		// $email_to = "ohiomobaalfred@gmail.com";
	
		M::sendEmail($email_to, $user->name, $user->name." from Gratisbuzz", $text);

		$data = [
            "success"=>true,
            "message"=>"Your message has been sent. The gratisbuzz team would get back to you by email."
        ];
		
		return response()->json($data, 200);
	}

	function allVendors(){
		$vendors = Vendor::where(['find'=>true])->get();

		return response()->json($vendors, 200);
    }
    
    function allVendorsSearch(Request $req){
        $vendors = Vendor::where(['find'=>true])->get();

        $post = $req->all();
        
        $newVendors = [];
		foreach($vendors as $vendor){
			
			if($post['category'] != "All"){
				if($vendor->category != $post['category']){
					continue;
				}
			}
			
			if($post['lga'] != "All"){
				if (strpos($vendor->location, $post['lga']) === false) {
					continue;
				}
			}
			
			if($post['state'] != "All"){
				if (strpos($vendor->location, $post['state']) === false) {
					continue;
				}
			}
			
			$newVendors[] = $vendor;
			
		}
        
        return response()->json($newVendors, 200);
    }

	function addToBrandFinder(Vendor $vendor){
		$vendor->find = true;

		$vendor->save();

		$data = [
            "success"=>true,
            "message"=>"Your company has been added to brand finder"
        ];
		
		return response()->json($data, 200);
    }
    
    function removeFromBrandFinder(Vendor $vendor){
        $vendor->find = false;
        
        $vendor->save();

        $data = [
            "success"=>true,
            "message"=>"Your company has been removed from brand finder"
        ];
        
        return response()->json($data, 200);
    }

	function makePromoInteractive(Promo $promo){
		$promo->sharable = true;
		$promo->save();

		$data = [
            "success"=>true,
            "message"=>"Your promo can now be interacted with"
        ];
		
		return response()->json($data, 200);
	}
}
