<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Question;
use App\Models\Ad;
use App\Helpers\M;

class QuestionController extends Controller
{
    public function add(){
        return view("admin.pages.questions.addQuestion");
    }

    public function allocate(){
        $questions = Question::get();
        $ads = Ad::with("vendor")->get();
        
        return view("admin.pages.questions.allocateQuestion", compact("questions", "ads"));
    }

    public function lists(){
        $questions = Question::get();
        
        return view("admin.pages.questions.listQuestion", compact("questions"));
    }

    public function createBatch(){
        return view("admin.pages.batch.addBatch");
    }

    public function assignBatch(){
        return view("admin.pages.batch.assignBatch");
    }

    function createQuestion(Request $request){
        $post = $request->input();
        
        $question = Question::create($post);

        M::flash("Successfully added question");

        return back();
    }
}
