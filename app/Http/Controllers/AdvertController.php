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
        return view("admin.pages.advert.pending");
    }



}
