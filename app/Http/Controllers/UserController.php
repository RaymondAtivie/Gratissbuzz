<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Vendor;
use App\Helpers\M;

use Auth; 

class UserController extends Controller
{
    public function login(Request $req){
        $output = [
            "status"=>"failed"
        ];

        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $output['user'] = Auth::user();

            if(count($output['user']->vendor) > 0){
                $output['user']['vendor'] = $output['user']->vendor;
            }else{
                $output['user']['vendor'] = [];
            }
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
            'location' => $req->location,
            'gender' => $req->gender,
            'status' => $req->status,
            'password' => bcrypt($req->password),
        ]);
        $output['message'] = "Successfully logged in";

		return response()->json($output, 201);
    }

    public function viewAll(){
        $users = User::get();

        return view("admin.pages.users.viewall", compact("users"));
    }

    public function viewAllVendors(){
        $vendors = Vendor::get();

        return view("admin.pages.users.viewallvendors", compact("vendors"));
    }

    public function messageAll(){

        return view("admin.pages.users.messageall", compact("vendors"));
    }

    public function sendMessageToAll(Request $request){
        $post = $request->all();

        $users = User::get();

        foreach($users as $user){
            M::sendMessage($post['title'], $post['message'], $post['type'], $user->id);
            // TODO: Send email to everyone too
        }
        
        M::flash("successfully sent to everyone", "success");

        return back();

    }

    public function sendMessageToOne(Request $request){
        $post = $request->all();
        
        M::sendMessage($post['title'], $post['message'], $post['type'], $post['user_id']);
        // TODO: Send email to user too
        
        M::flash("Message successfully sent", "success");

        return back();

    }
}
