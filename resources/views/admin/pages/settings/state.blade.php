@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            States and LGA
        </h3>
        <span class="sub-title">Add a new State or LGA</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">
        <div class="row" ng-controller="qCtrl as Q">
        
            <div class="col-md-12">
                @include("partials/flash")
            </div>     

            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add a new State
                    </header>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off" action="{{ url('settings/addState') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>State</h4>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Add State</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
            
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add a new LGA
                    </header>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off" action="{{ url('settings/addLga') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>State</h4>
                                    <select name="state_id" required class="form-control">
                                        <option value="">--SELECCT STATE--</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4>LGA</h4>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Add LGA</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <section class="panel">
                    <header class="panel-heading">
                        List
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @foreach($allStates as $statename => $lgas)
                                <h3>
                                    {{$statename}}
                                    <small>
                                        <a href="{{url('settings/removeState/'.$statename)}}"
                                            onclick="return confirm('Are you sure you want to delete this State: {{$statename}}, and its LGAs?')"
                                            class="btn btn-danger btn-sm float-right"><i class="fa fa-trash"></i></a>
                                    </small>
                                </h3>
                                <table class="table">
                                    @foreach($lgas as $lga)
                                        <tr>
                                            <td>{{$lga}}</td>
                                            <td style="text-align: right">
                                                <a href="{{url('settings/removeLGA/'.$lga)}}"
                                                onclick="return confirm('Are you sure you want to delete this LGA: {{$lga}}')"
                                                    class="btn btn-danger btn-sm">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endforeach
                        </div>
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
