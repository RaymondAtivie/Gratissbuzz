@extends('layout.default')
@section('title')
    Live Ad Batches
@stop
@section('main')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Batches
        </h3>
        <span class="sub-title">All Batches</span>
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
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            
                <section class="panel">
                    <header class="panel-heading">
                        Add new Batch
                    </header>
                    <div class="panel-body">
                        <form action="{{url('advert/newbatch')}}" method="POST" enctype="multipart/form-data">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Name</h4>
                                    <input type="text" required name="name" placeholder="e.g BATCH A" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Begin Date</h4>
                                    <input type="date" required name="day_begin_date" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>End Date</h4>
                                    <input type="date" required name="day_end_date" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Minutes for each Ad</h4>
                                    <select name="minutes_to_show" class="form-control">
                                        <option value="30">30 mins</option>
                                        @for($i=5;$i<=60;$i = $i+5)
                                        <option value="{{$i}}">{{$i}} mins</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Time of Day to Begin</h4>
                                    <input type="text" required name="day_begin_time" class="timepicker form-control" />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Time of Day to End</h4>
                                    <input type="text" required name="day_end_time" class="timepickerend form-control" />
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" value="ADD" class="btn btn-primary" />
                                </div>
                            </div>

                        </form>
                    </div>
                </section>

            </div>
        </div>

        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Batch List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Batch Name
                                    </th>
                                    <th>
                                        Begins Date
                                    </th>
                                    <th>
                                        End Date
                                    </th>
                                    <th>
                                        Minutes for Ad
                                    </th>
                                    <th>
                                        Time of Day
                                    </th>
                                    <th>
                                        Total Slots
                                    </th>
                                    {{-- <th>
                                        Avail Slots
                                    </th> --}}
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batches as $b)
                                    <tr>
                                        <td>
                                            {{$b->name}}
                                        </td>
                                        <td>
                                            {{$b->day_begin_date->format("d M Y")}}
                                        </td>
                                        <td>
                                            {{$b->day_end_date->format("d M Y")}}
                                        </td>
                                        <td>
                                            {{$b->minutes_to_show}} mins
                                        </td>
                                        <td>
                                            {{date("h:i a", strtotime($b->day_begin_time))}}
                                            -
                                            {{date("h:i a", strtotime($b->day_end_time))}}
                                        </td>
                                        <td>
                                            {{$b->slots()}}
                                        </td>
                                        {{-- <td>
                                            {{$b->availableSlots()}}
                                        </td> --}}
                                        <td style="text-align: right">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> Remove
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });

        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            defaultTime: '7',
            startTime: '06:30',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('.timepickerend').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            defaultTime: '17',
            startTime: '16:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
    </script>
@stop
