<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Helpers\M;

use App\Http\Requests;

class ContentController extends Controller
{   
    public function faq(){
        $faq = Content::where(['name'=>"faq"])->first();
        
        return view("admin.pages.content.faq", compact('faq'));
    }

    public function addfaq(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $FAQ = Content::where(['name'=>$name])->first();

        $FAQ->content = $content;
        $FAQ->save();

        M::flash("FAQ has been Updated", "success");
        return back();
    }
    
    public function about(){
        $about = Content::where(['name'=>"about"])->first();
        
        return view("admin.pages.content.about", compact('about'));
    }

    public function addabout(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $about = Content::where(['name'=>$name])->first();

        $about->content = $content;
        $about->save();

        M::flash("About Us has been Updated", "success");
        return back();
    }
    
    public function contact(){
        $contact = Content::where(['name'=>"contact"])->first();
        
        return view("admin.pages.content.contact", compact('contact'));
    }

    public function addcontact(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $contact = Content::where(['name'=>$name])->first();

        $contact->content = $content;
        $contact->save();

        M::flash("Contact Us has been Updated", "success");
        return back();
    }

    public function how(){
        $how = Content::where(['name'=>"how"])->first();
        
        return view("admin.pages.content.how", compact('how'));
    }

    public function addhow(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $how = Content::where(['name'=>$name])->first();

        $how->content = $content;
        $how->save();

        M::flash("How it works has been Updated", "success");
        return back();
    }

    public function terms(){
        $terms = Content::where(['name'=>"terms"])->first();
        
        return view("admin.pages.content.terms", compact('terms'));
    }

    public function addterms(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $terms = Content::where(['name'=>$name])->first();

        $terms->content = $content;
        $terms->save();

        M::flash("Terms and Conditions been Updated", "success");
        return back();
    }

    public function privacy(){
        $privacy = Content::where(['name'=>"privacy"])->first();
        
        return view("admin.pages.content.privacy", compact('privacy'));
    }

    public function addprivacy(Request $req){
        $post = $req->all();
        $name = $post['name'];
        $content = $post['content'];

        $privacy = Content::where(['name'=>$name])->first();

        $privacy->content = $content;
        $privacy->save();

        M::flash("Terms and Conditions been Updated", "success");
        return back();
    }
}
