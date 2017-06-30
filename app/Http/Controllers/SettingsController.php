<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\M;

class SettingsController extends Controller
{
    public function business(){

        $qcs = M::getBusinessCategories();
        return view("admin.pages.settings.business", compact("qcs"));
    }

    public function addBusiness(Request $request){
        M::addBusinessCategory($request->name);

        M::flash("Successfully added business category", "success");

        return back();
    }

    public function removeBusiness($b_id){
        M::removeBusinessCategory($b_id);

        M::flash("Successfully removed business category", "success");

        return back();
    }

    public function states(){
        $allStates = M::getStatesArray();
        $states = M::getStates();
        return view("admin.pages.settings.state", compact("allStates", "states"));
    }

    public function addState(Request $request){
        M::addState($request->name);

        M::flash("Successfully added a new state", "success");

        return back();
    }

    public function removeState($statename){
        M::removeState($statename);

        M::flash("Successfully removed State", "success");

        return back();
    }

    public function addLga(Request $request){
        M::addLGA($request->name, $request->state_id);

        M::flash("Successfully added LGA", "success");

        return back();
    }

    public function removeLGA($lganame){
        M::removeLGA($lganame);

        M::flash("Successfully removed LGA", "success");

        return back();
    }
}
