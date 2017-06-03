<?php
namespace App\Helpers;

use DB;
use Carbon\Carbon;

class M
{
    static function flash($message, $status='info')
    {
        session()->flash("issue_status", $status);
        session()->flash("issue_message", $message);
    }

    static function getQuestionCategories(){
         return collect(DB::table('question_categories')->get())->lists("name")->toArray();
    }

    static function addQuestionCategory($newCat){
          DB::table("question_categories")
            ->insert([
                'name'=>$newCat
            ]);
    }

    static function getBusinessCategories(){
         return collect(DB::table('business_category')->get())->lists("name")->toArray();
    }
    
    static function addBusinessCategory($newCat){
          DB::table("business_category")
            ->insert([
                'name'=>$newCat
            ]);
    }

    static function getStatesArray(){
        $all = [];
        $states = DB::table("states")->get();

        foreach ($states as $state) {
            $all[$state->name] = collect(DB::table('lga')->where("state_id", $state->id)->get())->lists("name")->toArray();
        }

        return $all;
        
    }

    static function getStates(){
        $states = DB::table('states')->get();

        return $states;   
    }

    static function addState($newState){
          DB::table("states")
            ->insert([
                'name'=>$newState
            ]);
    }

    static function addLGA($newState, $state_id){
          DB::table("lga")
            ->insert([
                'state_id'=>$state_id,
                'name'=>$newState
            ]);
    }

    static function getStandardAds(){
        return DB::table('standard_ads')->get();
    }

    static function setStandardAds($imageUrl, $link, $beginTimestamp, $endTimestamp){
        $input = [
            "image"=>$imageUrl,
            "link"=>$link,
            "begin"=> Carbon::createFromTimestamp($beginTimestamp, 'Africa/Lagos'),
            "end"=> Carbon::createFromTimestamp($endTimestamp, 'Africa/Lagos')
        ];

        DB::table('standard_ads')->insert($input);
    }

    static function sendMessage($title, $message, $type, $user_id){
        $input = [
            "title"=>$title,
            "message"=>$message,
            "type"=> $type,
            "user_id"=> $user_id
        ];

        DB::table('admin_messages')->insert($input);
    }

    static function getUserMessages($user_id){
        return DB::table("admin_messages")->where(["user_id" => $user_id])->orderBy("created_at", "DESC")->get();
    }

    static function getUserMessagesNum($user_id){
        $totalM = DB::table("admin_messages")->where(["user_id" => $user_id])->count();
        $unreadM = DB::table("admin_messages")->where(["user_id" => $user_id, "seen"=>"0"])->count();

        return ["total"=>$totalM, "unread"=>$unreadM];
    }

    static function readMessage($message_id){
        return DB::table("admin_messages")->where(["id" => $message_id])->update(["seen"=>"1"]);
    }

}


?>
