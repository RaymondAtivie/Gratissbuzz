<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

use Auth; 

class UserController extends Controller
{
    public function login(Request $req){
        $output = [
            "status"=>"failed"
        ];

        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $output['user'] = Auth::user();
            $output['user']['vendor'] = $output['user']->vendor;
            $output['status'] = "success";
            $output['message'] = "Successfully logged in";
        }else{
            $output['message'] = "Username or password is incorrect";
        }

		return response()->json($output, 200);
    }
}
