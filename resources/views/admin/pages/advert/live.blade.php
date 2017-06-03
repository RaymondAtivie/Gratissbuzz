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
                                        Company
                                    </th>
                                    <th class="col-md-1">
                                        Live
                                    </th>
                                    <th class="col-md-1">
                                        Batch
                                    </th>
                                    <th class="col-md-1">
                                        Image
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Ad Begin
                                    </th>
                                    <th>
                                        Question Begin
                                    </th>
                                    <th>
                                        Ad End
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
                                @foreach($lAds as $la)
                                    <tr>
                                        <td>
                                            <button class="btn btn-link" data-toggle="modal" data-target="#vendorModal{{$la->ad->vendor->id}}">
                                                {{$la->ad->vendor->name}}
                                            </button>
                                        </td>
                                        <td>
                                            @if($la->isLive())
                                                <i class="fa fa-circle" style="color: green"></i>
                                            @else
                                                <i class="fa fa-circle" style="color: yellow"></i>
                                            @endif
                                        </td>
                                        <td>
                                           {{$la->batch->name}}
                                        </td>
                                        <td data-featherlight="#lightbox{{$la->ad->id}}">
                                            <img src="{{$la->ad->image}}" id="lightbox{{$la->ad->id}}" class="img-responsive" />
                                        </td>
                                        <td>
                                            <small>{{$la->ad->description}}</small>
                                        </td>
                                        <td title="{{$la->begin->format('d M Y h:ia')}}">
                                            <small>{{$la->begin->format('d M Y h:ia')}}<br />
                                            {{$la->begin->diffForHumans()}}</small>
                                        </td>
                                        <td title="{{$la->question_begin->format('d M Y h:ia')}}">
                                            <small>{{$la->question_begin->format('d M Y h:ia')}}<br />
                                            {{$la->question_begin->diffForHumans()}}</small>
                                        </td>
                                        <td title="{{$la->end->format('d M Y h:ia')}}">
                                            <small>{{$la->end->format('d M Y h:ia')}}<br />
                                            {{$la->end->diffForHumans()}}</small>
                                        </td>
                                        <td title="{{$la->created_at->format('d M Y h:ia')}}">
                                            {{$la->created_at->diffForHumans()}}
                                        </td>
                                        <td style="text-align: right">
                                             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#liveDetails{{$la->id}}">
                                                <i class="fa fa-info-circle"></i> &nbsp; Details
                                            </button>
                                             <a href="{{url('advert/liveads/remove/'.$la->id)}}" onclick="return confirm('Are you sure you want to remove this Live Ad?')" class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> &nbsp; Remove
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="vendorModal{{$la->ad->vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.vendorBox", ["vendor" => $la->ad->vendor])
                                    </div>
                                    <!-- GO LIVE Modal -->
                                    <div class="modal fade" id="liveDetails{{$la->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{$la->ad->vendor->name}}'s Promo</h4>
                                                </div>
                                                <form action="{{url('advert/adgolive/'.$la->ad->id)}}" method="POST">
                                                    <input type="hidden" name="selection_method" value="{{$la->ad->selection_method}}" />
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <img class="img-responsive" src="{{$la->ad->image}}" />
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <p>{{$la->ad->description}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1 col-md-offset-1">
                                                                <p><b>Incentive</b></p>
                                                            </div>
                                                            <div class="col-md-9 col-md-offset-1">
                                                                <p>{{$la->ad->incentive}}</p>
                                                                <p>(Worth: N{{number_format($la->ad->incentive_amt)}})</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-1 col-md-offset-1">
                                                                <p><b>Question</b></p>
                                                            </div>
                                                            <div class="col-md-9 col-md-offset-1">
                                                                <p>{{$la->question->question}}</p>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="row">
                                                            <div class="col-md-1 col-md-offset-1">
                                                                <p><b>Begin</b></p>
                                                            </div>
                                                            <div class="col-md-9 col-md-offset-1">
                                                                <p>{{$la->begin->format('d M Y h:ia')}}</p>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="row">
                                                            <div class="col-md-1 col-md-offset-1">
                                                                <p><b>End</b></p>
                                                            </div>
                                                            <div class="col-md-9 col-md-offset-1">
                                                                <p>{{$la->end->format('d M Y h:ia')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Remove From Live!</button>
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
