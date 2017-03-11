<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

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

    public function signup(Request $req){
        $output = [
            "status"=>"success"
        ];

         $output['user'] = User::create([
            'name' => $req->name,
            'image' => url('assets/images/vendor/unknown.jpg'),
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => bcrypt($req->password),
        ]);
        $output['message'] = "Successfully logged in";

		return response()->json($output, 201);
    }
}
