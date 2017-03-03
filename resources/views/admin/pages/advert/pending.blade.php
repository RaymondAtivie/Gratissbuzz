@extends('layout.default')
@section('title')
    Pending Cashless Adverts
@stop
@section('main')
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
                        Advert List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Vendor
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
                                @foreach($pAds as $a)
                                    <tr>
                                        <td>
                                            {{$a->vendor->name}}
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
                                            <a href="{{url('advert/approve/'.$a->id)}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i> Approve
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> Cancel
                                            </button>
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
