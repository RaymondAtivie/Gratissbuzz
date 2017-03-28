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
        $qcs = M::getQuestionCategories();
        return view("admin.pages.questions.addQuestion", compact("qcs"));
    }

    public function addCategory(){
        $qcs = M::getQuestionCategories();
        return view("admin.pages.questions.addCategory", compact("qcs"));
    }

    public function addNewCategory(Request $request){
        M::addQuestionCategory($request->name);

        M::flash("Successfully added question category", "success");

        return back();
    }

    public function allocate(){
        $questions = Question::where('deleted', '0')->get();
        $ads = Ad::with("vendor")->get();
        
        return view("admin.pages.questions.allocateQuestion", compact("questions", "ads"));
    }

    public function lists(){
        $questions = Question::where('deleted', '0')->get();
        $qcs = M::getQuestionCategories();
        
        return view("admin.pages.questions.listQuestion", compact("questions", "qcs"));
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

    function deleteQuestion(Question $question, Request $request){
        $question->deleted = true;
        $question->save();

        M::flash("Successfully deleted question", "success");

        return back();
    }

    function editQuestion(Question $question, Request $request){
        $post = $request->input();

        $question->question = $post['question'];
        $question->answer = $post['answer'];
        $question->category = $post['category'];

        if($question->type == 'obj'){
            $question->option_a = $post['option_a'];
            $question->option_b = $post['option_b'];
            $question->option_c = $post['option_c'];
            $question->option_d = $post['option_d'];
        }
        
        $question->save();

        M::flash("Successfully eddited question", "success");

        return back();
    }
}
