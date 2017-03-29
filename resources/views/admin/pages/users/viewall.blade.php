@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            All Users
        </h3>
        <span class="sub-title">A List of all Users</span>
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

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Users List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        S/N
                                    </th>
                                    <th class="col-sm-1">
                                        Picture
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email / Phone
                                    </th>
                                    <th>
                                        Location
                                    </th>
                                    <th>
                                        Sex
                                    </th>
                                    <th class="col-sm-2">
                                        Vendors
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$i+1}}
                                        </td>
                                        <td style="text-align: center">
                                            <img src="{{$user->image}}" style="margin: auto" class="img-responsive img-circle" />
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}} <br /> {{$user->phone}}
                                        </td>
                                        <td>
                                            {{$user->location}}
                                        </td>
                                        <td>
                                            {{$user->gender}}
                                        </td>
                                        <td>
                                            <small>{{implode(", ", $user->vendor->lists('name')->toArray() )}}</small>
                                        </td>
                                        <td>
                                            <button href="#" class="btn btn-warning" data-toggle="modal" data-target="#sendMessage{{$user->id}}">Send Message</button>
                                        <!--
                                            <a href="{{url('question/'.$user->id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                                       -->
                                         </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="sendMessage{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.singleMessageBox", ["user" => $user])
                                    </div>
                                    <?php $i++; ?>
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
