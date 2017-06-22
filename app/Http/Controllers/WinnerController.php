<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveAd;
use App\Models\Winner;
use App\Models\AdsAnswer;
use App\User;

use App\Http\Requests;

class WinnerController extends Controller
{
    private $now;
    
    function __construct(){
        $this->now = \Carbon\Carbon::now("Africa/Lagos");
    }

    public function getWinners(){
        $winners = Winner::with(["user", "livead.ad.vendor", "answer"])->get();

        $data = [
            "success"=>true,
            "message"=>"winners succesfully retrieved",
            "data" => $winners
        ];

        return response()->json($data, 200);        
    }

    public function processWinners(){
        $lads = LiveAd::
            where("end", "<=", $this->now->copy()->endOfDay())
            ->where(["winners_done"=>"0"])->get();

        $winners = collect([]);

        foreach($lads as $lad){
            if($lad->ad->selection_method == 'random'){
                $result = $this->processRandom($lad);

                if($result){
                    $winners = $winners->merge($result);
                }
            }elseif($lad->ad->selection_method == 'first'){
                $result = $this->processFirst($lad);

                if($result){
                    $winners = $winners->merge($result);
                }
            }

            $lad->winners_done = true;
            $lad->save();
        }
        
        foreach ($winners as $winner) {
            $this->addToWinnersList($winner['user'], $winner['live_ad'], $winner['answer']);
        }
        
        return response()->json($winners, 200);
    }

    private function processRandom($liveAd){
        $answers = $liveAd->answers()->where(['correct_status'=>'1'])->inRandomOrder()->get();
        $noWinners = $liveAd->ad->possible_winners;

        if(count($answers) < $noWinners){
            $counter = count($answers);
        } else{
            $counter = $noWinners;
        }

        $winners = false;
        for($i=0;$i<$counter;$i++){
            $data = [
                "user"=>User::find($answers[$i]->user_id),
                "answer"=>$answers[$i],
                "live_ad"=>$liveAd
            ];
            $winners[] = $data;
        }

        return $winners;        
    }

    private function processFirst($liveAd){
        $answers = $liveAd->answers()->where(['correct_status'=>'1'])->orderBy('created_at', "ASC")->get();
        $noWinners = $liveAd->ad->possible_winners;

        if(count($answers) < $noWinners){
            $counter = count($answers);
        } else{
            $counter = $noWinners;
        }

        $winners = false;
        for($i=0;$i<$counter;$i++){
            $data = [
                "user"=>User::find($answers[$i]->user_id),
                "answer"=>$answers[$i],
                "live_ad"=>$liveAd
            ];
            $winners[] = $data;
        }

        return $winners;        
    }

    private function addToWinnersList(User $user, LiveAd $lad, AdsAnswer $answer){
        $data = [
            "user_id"=>$user->id,
            "live_ad_id"=>$lad->id,
            "ads_answer_id"=>$answer->id,
            "winner_token"=>$this->genKey(9),
        ];
        $lad->winners_done = true;
        $lad->save();
        Winner::create($data);
    }

    private function genKey($random_string_length){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

}
