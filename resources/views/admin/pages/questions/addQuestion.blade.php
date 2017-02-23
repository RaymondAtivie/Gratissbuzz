@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Questions
        </h3>
        <span class="sub-title">Add a new Question</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">
        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add a new Question
                    </header>
                    <div class="panel-body">
                        <form method="POST" enctype="multipart/form-data" autocomplete="off" action="{{ url('admin/home/changeLogo/') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Question</h4>
                                    <textarea name="name" class="form-control" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="btn-group btn-group-justified" data-toggle="buttons">
                                    <label class="btn btn-default active" ng-click="Q.switch('obj')">
                                        <input type="radio" name="type" value="obj" id="option1" autocomplete="off" checked> Objective
                                    </label>
                                    <label class="btn btn-default" ng-click="Q.switch('theory')">
                                        <input type="radio" name="type" value="theory" id="option2" autocomplete="off"> Theory
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12" ng-show="Q.type == 'obj'">
                                <h4>Answer Options</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="answer" value="A">
                                            </span>
                                            <span class="input-group-addon"><b>A</b></span>
                                            <input type="text" class="form-control" placeholder="Option A">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="answer" value="B">
                                            </span>
                                            <span class="input-group-addon"><b>B</b></span>
                                            <input type="text" class="form-control" placeholder="Option B">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="answer" value="C">
                                            </span>
                                            <span class="input-group-addon"><b>C</b></span>
                                            <input type="text" class="form-control" placeholder="Option C">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="answer" value="D">
                                            </span>
                                            <span class="input-group-addon"><b>D</b></span>
                                            <input type="text" class="form-control" placeholder="Option D">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12"  ng-show="Q.type == 'theory'">
                                <h4>Theory Answer</h4>
                                <textarea name="name" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="col-sm-12">
                                <hr />
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Add Question</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

        </div>
    </div>
@stop
@section('styles')
@stop
@section('scripts')
    <script src="{{ url('js/angular.min.js') }}"></script>
    <script>
    angular.module('gratisApp', [])
    .controller('qCtrl', function() {
        this.type = 'obj';

        this.switch = function(title){
            this.type = title;
        }
    });
    </script>
@stop
