<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = ['id'];
	protected $dates = ['day_begin_date', 'day_end_date', 'last_ad_end'];

    public function slots(){
        $minutesDiff = (strtotime($this->day_end_time) - strtotime($this->day_begin_time)) / 60;
        $slotsADay = $minutesDiff/$this->minutes_to_show;

        $totalDays = $this->day_end_date->diffInDays($this->day_begin_date) + 1;
        
        // return($this->day_end_date->format("d M-H:i a")." - ".$this->day_begin_date->format("d M-H:i a")." - ".$totalDays);
        $totalSlots = $slotsADay * $totalDays;

        return $totalSlots;
    }

    // public function availableSlots(){
    //     $minutesDiff = strtotime($this->day_end_time) - strtotime($this->day_begin_time);
    //     $slotsADay = ($minutesDiff/60)/$this->minutes_to_show;

    //     $totalDays = $this->last_ad_end->diffInDays($this->day_begin_date) + 1;
        
    //     $totalSlots = $slotsADay * $totalDays;

    //     return $totalSlots;
    // }

    //RELATIONSHIP
    public function liveads()
    {
        return $this->hasMany("App\Models\LiveAd");
    }

}
