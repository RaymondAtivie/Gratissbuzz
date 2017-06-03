<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use App\Slim;
use App\User;
use App\Helpers\M;
use App\Models\Ad;
use App\Models\Promo;
use App\Models\LivePromo;
use App\Models\LiveAd;
use App\Models\Question;
use App\Models\Batch;

class AdvertController extends Controller
{
    public function login() {
        $user = Input::get('username');
        $password = Input::get('password');

        if (Auth::guard('admin')->attempt(['email' => $user, 'password' => $password])) {
            return redirect()->intended('/');
        }else{
            return Redirect::to('/login')->withErrors("Wrong details");
        }
    }

    public function pendingAds(){
        $pAds = Ad::approved(false)->get();     
        
        return view("admin.pages.advert.pending", compact("pAds"));
    }

    public function showApprovedAds(){
        $aAds = Ad::approved()->get();
        $questions = Question::get();
        $batches = Batch::orderBy("created_at", "DESC")->get();

        return view("admin.pages.advert.approved", compact("aAds", "questions", "batches"));
    }

    public function approveAd(Request $request, Ad $ad){
        $ad->approved = true;
        $ad->save();

        M::flash("The advert has been approved");

        return Redirect::back();
    }

    public function unapproveAd(Request $request, Ad $ad){
        $ad->approved = false;
        $ad->save();

        M::flash("The advert has been un-approved", "warning");
        
        return Redirect::back();
    }

     public function pendingPromos(){
        $pAds = Promo::approved(false)->get();        
        
        return view("admin.pages.promo.pending", compact("pAds"));
    }

    public function showApprovedPromos(){
        $aAds = Promo::approved()->get();

        return view("admin.pages.promo.approved", compact("aAds"));
    }

    public function approvePromo(Request $request, Promo $promo){
        $promo->approved = true;
        $promo->save();

        M::flash("The Promo has been approved");

        return Redirect::back();
    }

    public function unapprovePromo(Request $request, Promo $promo){
        $promo->approved = false;
        $promo->save();

        M::flash("The Promo has been un-approved", "warning");
        
        return Redirect::back();
    }

    public function promoGoLive(Request $request, Promo $promo){
        $input = $request->all();

        $beginDate = Carbon::createFromTimestamp(strtotime($input['begin']), 'Africa/Lagos');
        $endDate = Carbon::createFromTimestamp(strtotime($input['end']), 'Africa/Lagos');

        $lp = [
            "promo_id" => $promo->id,
            "vendor_id" => $promo->vendor->id,
            "begin" => $beginDate,
            "end" => $endDate,
        ];

        $livep = LivePromo::create($lp);

        $message = "The promo has successfully gone Live. It would show between <b>".
                    $beginDate->format('l jS \\of F Y h:i A') . "</b> and <b>". 
                    $endDate->format('l jS \\of F Y h:i A'). "</b>";

        M::flash($message, "success");

        return Redirect::back();
    }

    public function adGoLive(Request $request, Ad $ad){
        $input = $request->all();

        $batch = Batch::find($input['batch_id']);

        if(count($batch->liveAds) >= $batch->slots()){
             M::flash("Cannot add this ad to batch because, <b>this batch is full</b>", "danger");

            return Redirect::back();
        }

        if($input['question'] == 'random'){
            $question_id = Question::inRandomOrder()->first()->id;
        }else{
            if(!$request->question_id){
                $question_id = Question::inRandomOrder()->first()->id;
            }else{
                $question_id = $input['question_id'];
            }
        }

        $last_time_today =  Carbon::createFromFormat("Y-m-d H:i:s", date("Y-m-d", strtotime($batch->last_ad_end))." ".date("H:i:s", strtotime($batch->day_end_time)), 'Africa/Lagos');

        //if the last ad date is greater than the time 
        if($batch->last_ad_end->gte($last_time_today)){
            $first_time_tomorrow =  Carbon::createFromFormat("Y-m-d H:i:s", date("Y-m-d", strtotime($batch->last_ad_end->addDay()))." ".date("H:i:s", strtotime($batch->day_begin_time)), 'Africa/Lagos');
            $last_ad_end = $first_time_tomorrow;
        }else{
            $last_ad_end = $batch->last_ad_end;
        }

        $fakeBeginDate = clone $last_ad_end;
        $beginDate = clone $last_ad_end;
        $endDate = $last_ad_end->addMinutes($batch->minutes_to_show); 

        $totalSeconds = $fakeBeginDate->diffInseconds($endDate);
        if($totalSeconds % 2 == 1){
            $totalSeconds++;
        }
        $newSeconds = ceil($totalSeconds/2);
        $question_begin = $fakeBeginDate->addSeconds($newSeconds);

        $selection_method = $input['selection_method'];

        $lp = [
            "ad_id" => $ad->id,
            "vendor_id" => $ad->vendor->id,
            "question_id" => $question_id,
            "selection_method" => $selection_method,
            "question_begin" => $question_begin,
            "begin" => $beginDate,
            "end" => $endDate,
            "batch_id" => $batch->id
        ];

        $livep = LiveAd::create($lp);

        $batch->last_ad_end = $livep->end;
        $batch->save();

        $message = "The Ad has successfully gone Live. It would show between <b>".
                    $beginDate->format('l jS \\of F Y h:i A') . "</b> and <b>". 
                    $endDate->format('l jS \\of F Y h:i A') . "</b>";

        M::flash($message, "success");

        return Redirect::back();
    }

    public function showLiveAds(Request $request){
		
        $now = \Carbon\Carbon::now('Africa/Lagos');
		$startOfDay = $now->startOfDay();
		$endOfDay = $now->startOfDay();

        $lAds = LiveAd::whereDate("end", ">=", $now)
        ->orderBy("begin", "ASC")->get();
        // $lAds = LiveAd::get();

        return view("admin.pages.advert.live", compact("lAds"));        
    }

    public function removeLiveAd(LiveAd $livead){
        $livead->delete();

         M::flash("Successfully removed", "success");

        return back();
    }

    public function removeLivePromo(LivePromo $livepromo){
        $livepromo->delete();

         M::flash("Successfully removed", "success");

        return back();
    }
    
    public function showLivePromos(Request $request){
		$now = \Carbon\Carbon::now('Africa/Lagos');
		$startOfDay = $now->startOfDay();
		$endOfDay = $now->startOfDay();

        $lAds = LivePromo::whereDate("end", ">=", $now)
        ->orderBy("begin", "ASC")->get();

        return view("admin.pages.promo.live", compact("lAds"));        
    }

    public function standardAds(){
        $sAds = M::getStandardAds();

        return view("admin.pages.advert.standard", compact("sAds"));  
    }

    public function addStandardAds(Request $request){
        $post = $request->all();

        $fileName = time().$request->file('image')->getClientOriginalName();
        
        $request->file('image')->move("assets/images/ads/", $fileName);
        
        $imageUrl = url("assets/images/ads/".$fileName);
        $link = $post['link'];
        $beginTimestamp = strtotime($post['begin']);
        $endTimestamp = strtotime($post['end']);

        $sAds = M::setStandardAds($imageUrl, $link, $beginTimestamp, $endTimestamp);

        M::flash("Successfully added", "success");

        return back();
    }

    public function showBatches(){
        $batches = \App\Models\Batch::get();

        return view("admin.pages.advert.batches", compact("batches"));  
    }

    public function showBatchAds(Batch $batch){
        
        return view("admin.pages.batch.batchAds", compact("batch"));  
    }

    public function removeBatch(Batch $batch){
        $bname = $batch->name;
        foreach($batch->liveAds as $la){
            $la->delete();
        }
        $batch->delete();

        M::flash("Successfully deleted Batch <b>$bname</b> and all its ads", "success");

        return back();
    }

    public function addBatch(Request $request){
        $post = $request->all();

        $day_begin = Carbon::createFromFormat("Y-m-d", $post['day_begin_date'], 'Africa/Lagos');
        $day_end = Carbon::createFromFormat("Y-m-d", $post['day_end_date'], 'Africa/Lagos');

        if($day_end->lt($day_begin)){
             M::flash("The <b>end date</b> must be greater than the <b>begin date</b>", "danger");

            return back();
        }

        $post['day_begin_time'] = date("H:i:s", strtotime($post['day_begin_time']));
        $post['day_end_time'] = date("H:i:s", strtotime($post['day_end_time']));

        $post['last_ad_end'] = date("Y-m-d", strtotime($post['day_begin_date']))." ".date("H:i:s", strtotime($post['day_begin_time']));

        $batch = \App\Models\Batch::create($post);

        M::flash("Successfully added a new batch", "success");

        return back();
    }
}
