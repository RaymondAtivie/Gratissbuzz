@extends('layout.default')
@section('title')
    Pending Promos
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Promos
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
                        Promo List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Vendor
                                    </th>
                                    <th class="col-md-2">
                                        Image
                                    </th>
                                    <th>
                                        Description
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
                                @foreach($pAds as $a)
                                    <tr>
                                        <td>
                                            {{$a->vendor->name}}
                                        </td>
                                        <td data-featherlight="#lightbox{{$a->id}}">
                                            <img src="{{$a->image}}" id="lightbox{{$a->id}}" class="img-responsive" />
                                        </td>
                                        <td>
                                            <small>{{$a->description}}</small>
                                        </td>
                                        <td title="{{$a->created_at->format('d M Y H:i a')}}">
                                            {{$a->created_at->diffForHumans()}}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{url('advert/approvepromo/'.$a->id)}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i> Approve
                                            </a>
                                        </td>
                                    </tr>
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
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });
    });
    </script>
@stop
