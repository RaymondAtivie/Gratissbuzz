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
                                @for($i=0;$i<10;$i++)
                                    <tr>
                                        <td>
                                            Reftek
                                        </td>
                                        <td>
                                            Free website
                                        </td>
                                        <td>
                                            {{number_format(14000)}}
                                        </td>
                                        <td>
                                            Random
                                        </td>
                                        <td>
                                            3 days ago
                                        </td>
                                        <td style="text-align: right">
                                            <button class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i> Approve
                                            </button>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> Cancel
                                            </button>
                                        </td>
                                    </tr>
                                @endfor
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
