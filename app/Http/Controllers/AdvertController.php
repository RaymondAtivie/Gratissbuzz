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

        return view("admin.pages.advert.approved", compact("aAds", "questions"));
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

        $beginDate = Carbon::createFromTimestamp(strtotime($input['begin']));
        $endDate = Carbon::createFromTimestamp(strtotime($input['end']));

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

        if($input['question'] == 'random'){
            $question_id = Question::inRandomOrder()->first()->id;
        }else{
            if(!$request->question_id){
                $question_id = Question::inRandomOrder()->first()->id;
            }else{
                $question_id = $input['question_id'];
            }
        }
        
        $beginDate = Carbon::createFromTimestamp(strtotime($input['begin']));
        $endDate = Carbon::createFromTimestamp(strtotime($input['end']));

        $totalSeconds = $beginDate->diffInseconds($endDate);
        if($totalSeconds % 2 == 1){
            $totalSeconds++;
        }
        $newSeconds = ceil($totalSeconds/2);
        $question_begin = $beginDate->addSeconds($newSeconds);

        $selection_method = $input['selection_method'];

        $lp = [
            "ad_id" => $ad->id,
            "vendor_id" => $ad->vendor->id,
            "question_id" => $question_id,
            "selection_method" => $selection_method,
            "question_begin" => $question_begin,
            "begin" => $beginDate,
            "end" => $endDate,
        ];

        $livep = LiveAd::create($lp);

        $message = "The Ad has successfully gone Live. It would show between <b>".
                    $beginDate->format('l jS \\of F Y h:i A') . "</b> and <b>". 
                    $endDate->format('l jS \\of F Y h:i A') . "</b>";

        M::flash($message, "success");

        return Redirect::back();
    }

    public function showLiveAds(Request $request){
		$now = \Carbon\Carbon::now();
		$startOfDay = $now->startOfDay();
		$endOfDay = $now->startOfDay();

        $lAds = LiveAd::whereDate("end", ">=", $now)
        ->orderBy("begin", "ASC")->get();

        return view("admin.pages.advert.live", compact("lAds"));        
    }
    
    public function showLivePromos(Request $request){
		$now = \Carbon\Carbon::now();
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
}
