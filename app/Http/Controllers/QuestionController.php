<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    public function add(){
        return view("admin.pages.questions.addQuestion");
    }

    public function allocate(){
        return view("admin.pages.questions.allocateQuestion");
    }

    public function lists(){
        return view("admin.pages.questions.listQuestion");
    }

    public function createBatch(){
        return view("admin.pages.batch.addBatch");
    }

    public function assignBatch(){
        return view("admin.pages.batch.assignBatch");
    }
}
