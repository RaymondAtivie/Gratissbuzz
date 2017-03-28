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

    static function getStandardAds(){
        return DB::table('standard_ads')->get();
    }

    static function setStandardAds($imageUrl, $link, $beginTimestamp, $endTimestamp){
        $input = [
            "image"=>$imageUrl,
            "link"=>$link,
            "begin"=> Carbon::createFromTimestamp($beginTimestamp),
            "end"=> Carbon::createFromTimestamp($endTimestamp)
        ];

        DB::table('standard_ads')->insert($input);
    }

}


?>
