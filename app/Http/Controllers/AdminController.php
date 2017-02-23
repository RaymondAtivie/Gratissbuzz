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
use App\Helpers\M;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\UserInfo;
use App\User;

class AdminController extends Controller
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

    public function loginpage(){
        if (Auth::guard('admin')->guest()) {
            return view('admin.login');
        }
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        \Session::flush();
        return Redirect::to('admin/login')->withMessage("See you soon");
    }

    public function dashboard(){
        return view('admin.pages.dashboard');
    }



}
