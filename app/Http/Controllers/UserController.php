<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Vendor;
use App\Helpers\M;

use Mail;
use Auth; 
use Image; 

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
            'username' => $req->username,
            'phone' => $req->phone,
            'location' => $req->location,
            'gender' => $req->gender,
            'status' => $req->status,
            'referal' => $this->genReferal(7),
            'refered' => $this->getReferedId($req->referal),
            'password' => bcrypt($req->password),
        ]);
        $output['message'] = "Successfully logged in";

        $text = "Welcome to GratisBuzz Digital Marketing Platform, where Small and Medium scale Entrepreneurs get the EXPOSURE they desire and User get appreciated for being a part of the process. For more information kindly visit How It Works and Frequently Asked Questions.";
        M::sendEmail($req->email, $req->name, "Welcome to Gratisbuzz", $text);

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
            M::sendEmail($user->email, $user->name, $post['title'], $post['message']);
        }
        
        M::flash("successfully sent to everyone", "success");

        return back();

    }

    public function sendMessageToOne(Request $request){
        $post = $request->all();
        
        M::sendMessage($post['title'], $post['message'], $post['type'], $post['user_id']);
        M::sendEmail($user->email, $user->name, $post['title'], $post['message']);
        
        M::flash("Message successfully sent", "success");

        return back();

    }

    private function genReferal($random_string_length){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

    private function getReferedId($referal){
        $user = User::where(['referal'=>$referal])->first();

        if($user){
            return $user->id;
        }else{
            return false;
        }
    }

    public function updatePicture(Request $request, $user_id){
        $user = User::find($user_id);
        $post = $request->all();

        $save_path = "upload_profile_pics/";
        $filename = rand(1000,9999999).time().".jpg";

		$img = Image::make($post['image']);
        $img->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })
            ->crop(150, 150)
        	->save($save_path.$filename);

        $user->image = url($save_path.$filename);

        $user->save();

        return response()->json(['message'=>'Successfully updated your profile picture', 'image'=>$user->image], 200);
    }

    public function updateVendorPicture(Request $request, $vendor_id){
        $vendor = Vendor::find($vendor_id);
        $post = $request->all();

        $save_path = "upload_vendor_pics/";
        $filename = rand(1000,9999999).time().".jpg";

		$img = Image::make($post['image']);
        $img->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })
            ->crop(150, 150)
        	->save($save_path.$filename);

        $vendor->image = url($save_path.$filename);

        $vendor->save();

        return response()->json(['message'=>'Successfully updated your vendor picture', 'image'=>$vendor->image], 200);
    }
}
