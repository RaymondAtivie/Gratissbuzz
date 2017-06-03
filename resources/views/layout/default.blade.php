<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>@yield('title') - Gratisbuzz Admin</title>

    <!--right slidebar-->
    <link href="{{ url('') }}/assets/admin/css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    {{-- <link href="j{{ url('') }}/assets/admin/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" /> --}}

    <!--common style-->
    <link href="{{ url('') }}/assets/admin/css/style.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/admin/css/style-responsive.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/admin/css/custom.css" rel="stylesheet">
    @yield('styles')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="index.html">
                    <img src="{{ url('images/event/event_logo_small.png') }}"  style="height: 50px" alt="">
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                @include('admin.includes.nav')


            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1200px;">

            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ url('admin') }}">
                        <img src="{{ url('images/event/event_logo_small.png') }}" style="height: 50px" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <!-- <span class="brand-name">TicketWire</span> -->
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ url('admin') }}">
                        <img src="" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>

                <div class="notification-wrap">
                <div class="right-notification">
                    <ul class="notification-menu">
                       <li>
                            <a href="javascript:;">
                                <span class="p-10 bg-success pull-right" style="padding: 0px 10px">
                                    {{Carbon\Carbon::now('Africa/Lagos')->format("d M Y h:i a")}}
                                </span>
                            </a>
                       </li>
                       <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ url('/assets/admin/img/avatar-mini.jpg') }}" alt=""> {{ Auth::guard('admin')->user()->name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                {{-- <li><a href="javascript:;">  Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-danger pull-right">40%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="label bg-info pull-right">new</span>
                                        Help
                                    </a>
                                </li> --}}
                                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
            @yield('main')

            <footer>
                {{date("Y")}} &copy; Gratissbuzz
            </footer>


        </div>
    </section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ url('') }}/assets/admin/js/jquery-1.10.2.min.js"></script>
<script src="{{ url('') }}/assets/admin/js/jquery-migrate.js"></script>
<script src="{{ url('') }}/assets/admin/js/bootstrap.min.js"></script>
<script src="{{ url('') }}/assets/admin/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="{{ url('') }}/assets/admin/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="{{ url('') }}/assets/admin/js/slidebars.min.js"></script>

<!--switchery-->
<script src="{{ url('') }}/assets/admin/js/switchery/switchery.min.js"></script>
<script src="{{ url('') }}/assets/admin/js/switchery/switchery-init.js"></script>

<!--Sparkline Chart-->
<script src="{{ url('') }}/assets/admin/js/sparkline/jquery.sparkline.js"></script>
<script src="{{ url('') }}/assets/admin/js/sparkline/sparkline-init.js"></script>


<!--common scripts for all pages-->
<script src="{{ url('') }}/assets/admin/js/scripts.js"></script>
@yield('scripts')
@yield('footer_scripts')

<script>
    $(function () {
        var pgurl = window.location.href;
        $("ul.side-navigation li a").each(function () {
            if ($(this).attr("href") == pgurl) {
//                $(this).parent('li').children('a').addClass("active");
                $(this).parent('li').addClass("active");
                $(this).parent('li').parent('ul').parent('li').addClass("active").trigger("click");
            }
        });
    });
    $('[type|="number"]').keydown(function(event) {
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9
            || event.keyCode == 27 || event.keyCode == 13
            || (event.keyCode == 65 && event.ctrlKey === true)
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                return;
        }else{
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });
</script>
</body>
</html>
