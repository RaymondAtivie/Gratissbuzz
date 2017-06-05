<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Vendor extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        "twitter_link", "facebook_link", "instagram_link", "youtube_link"
    ];

    //RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function ads()
    {
        return $this->hasMany("App\Models\Ad");
    }
    public function promos()
    {
        return $this->hasMany("App\Models\Promo");
    }
    public function liveads()
    {
        return $this->hasMany("App\Models\LiveAd");
    }
    public function livepromos()
    {
        return $this->hasMany("App\Models\LivePromo");
    }

    //EXTRA ATTRIBUTES
    public function getWebsiteAttribute($value){
        $scheme = 'http://';
        
        return parse_url($value, PHP_URL_SCHEME) === null ?
            $scheme . $value : $value;
    }

    public function getTwitterLinkAttribute($value){
        if($this->twitter){
            $username = trim(ltrim($this->twitter, "@"));
            return "https://www.twitter.com/".$username;
        }else{
            return false;
        }
    }

    public function getFacebookLinkAttribute($value){
        if($this->twitter){
            $username = trim($this->facebook);
            return "https://www.facebook.com/".$username;
        }else{
            return false;
        }
    }

    public function getInstagramLinkAttribute($value){
        if($this->twitter){
            $username = trim($this->instagram);
            return "https://www.instagram.com/".$username;
        }else{
            return false;
        }
    }

    public function getYoutubeLinkAttribute($value){
        if($this->twitter){
            $username = trim($this->youtube);
            return "https://www.youtube.com/".$username;
        }else{
            return false;
        }
    }
    
}