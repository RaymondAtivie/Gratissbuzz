@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            All Vendors
        </h3>
        <span class="sub-title">A list of all Vendors</span>
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
                        Vendors List
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
                                        Address
                                    </th>
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                                @foreach($vendors as $vendor)
                                    <tr>
                                        <td>
                                            {{$i+1}}
                                        </td>
                                        <td style="text-align: center">
                                            <img src="{{$vendor->image}}" style="margin: auto" class="img-responsive img-circle" />
                                        </td>
                                        <td>
                                            {{$vendor->name}}
                                        </td>
                                        <td>
                                            {{$vendor->email}} <br /> {{$vendor->phone}}
                                        </td>
                                        <td>
                                            {{$vendor->location}}
                                        </td>
                                        <td>
                                            {{$vendor->address}}
                                        </td>
                                        <td>
                                            {{$vendor->user->name}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#moreModal{{$vendor->id}}">More Info</a>
                                            <button href="#" class="btn btn-warning" data-toggle="modal" data-target="#sendMessage{{$vendor->id}}">Send Message</button>
                                         </td>
                                    </tr>


                                    <!-- Modal -->
                                    <div class="modal fade" id="sendMessage{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.singleMessageBox", ["user" => $vendor->user])
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="moreModal{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.vendorBox", ["vendor" => $vendor])
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
