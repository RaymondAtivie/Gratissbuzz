@extends('layout.default')
@section('title')
    Dashboard
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Dashboard
        </h3>
        <span class="sub-title">Welcome to Youpple Events</span>
    </div>

    <div class="wrapper">
        <h1>Welcome to Gratisbuzz Dashboard</h1>

        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-send"></i>
                    </div>
                    <div class="value white">
                        <h1 class="timer" data-from="0" data-to="320"
                        data-speed="1000">320</h1>
                        <p>Total Users</p>
                    </div>
                </section>
            </div>
        </div>

    </div>
@stop
@section('styles')
@stop
@section('scripts')
@stop
