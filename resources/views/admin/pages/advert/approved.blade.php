@extends('layout.default')
@section('title')
    Approved Cashless Adverts
@stop
@section('main')
    <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Cashless Adverts
        </h3>
        <span class="sub-title">Pending Approval</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">

        <div class="row">
            <div class="col-md-12">
                @include("partials/flash")
            </div>
        </div>
        
        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Approved Advert List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Vendor
                                    </th>
                                    <th class="col-md-1">
                                        Image
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Incentive
                                    </th>
                                    <th>
                                        Incentive Amt
                                    </th>
                                    <th>
                                        Random / First
                                    </th>
                                    <th>
                                        Created
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aAds as $a)
                                    <tr>
                                        <td>
                                            <button class="btn btn-link" data-toggle="modal" data-target="#vendorModal{{$a->vendor->id}}">
                                                {{$a->vendor->name}}
                                            </button>
                                        </td>
                                        <td data-featherlight="#lightbox{{$a->id}}">
                                            <img src="{{$a->image}}" id="lightbox{{$a->id}}" class="img-responsive" />
                                        </td>
                                        <td>
                                            <small>{{$a->description}}</small>
                                        </td>
                                        <td>
                                            {{$a->incentive}}
                                        </td>
                                        <td>
                                            {{number_format($a->incentive_amt)}}
                                        </td>
                                        <td>
                                            {{$a->selection_method}}
                                        </td>
                                        <td>
                                            {{$a->created_at->diffForHumans()}}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{url('advert/unapprove/'.$a->id)}}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-check"></i> Un-Approve
                                            </a>
                                             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#golive{{$a->id}}">
                                                <i class="fa fa-lightbulb-o"></i> &nbsp; Go Live!!!
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="vendorModal{{$a->vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.vendorBox", ["vendor" => $a->vendor])
                                    </div>

                                    <!-- GO LIVE Modal -->
                                    <div class="modal fade" id="golive{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{$a->vendor->name}}'s Promo</h4>
                                                </div>
                                                <form action="{{url('advert/adgolive/'.$a->id)}}" method="POST">
                                                    <input type="hidden" name="selection_method" value="{{$a->selection_method}}" />
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <img class="img-responsive" src="{{$a->image}}" />
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <p>{{$a->description}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <p><b>Incentive</b></p>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-1">
                                                                <p>{{$a->incentive}}</p>
                                                                <p>(Worth: N{{number_format($a->incentive_amt)}})</p>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>Begin</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <input class="form-control" required type="datetime-local" name="begin" />
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>End</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <input class="form-control" required type="datetime-local" name="end" />
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>Question</b>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="btn btn-primary active" ng-click="Q.qType = 'random'">
                                                                        <input type="radio" name="question" checked value="random" autocomplete="off" checked> Allocate Random Question
                                                                    </label>
                                                                    <label class="btn btn-primary" ng-click="Q.qType = 'select'">
                                                                        <input type="radio" name="question" value="select" autocomplete="off"> Pick Question
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" ng-show="Q.qType == 'select'">
                                                            <br />
                                                            <div class="col-md-12">
                                                                <div style="border: 1px solid grey; overflow-y: scroll; overflow-x: hidden; height: 350px; margin-right: -15px; margin-left: -15px">
                                                                    @foreach($questions as $q)
                                                                    <label class="row" style="display: block; border-bottom: 1px solid silver; max-width: none; padding: 10px 15px;">
                                                                        <div class="col-md-1">
                                                                            <input type="radio" name="question_id" value="{{$q->id}}" autocomplete="off"/>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <b>{{$q->question}}</b>
                                                                        </div>
                                                                        <div class="col-md-2" style="text-align: right">
                                                                            {{$q->type}}
                                                                        </div>
                                                                    </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info">Go Live!!!</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

    </div>
</div>
@stop

@section('styles')
@stop

@section('scripts')
    @include('admin.includes.datatable')
@endsection

@section('footer_scripts')
    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{ url('js/angular.min.js') }}"></script>
    <script>
    angular.module('gratisApp', [])
        .controller('qCtrl', function() {
            this.qType = 'random';
        });
    </script>
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });
    });
    </script>
@stop
