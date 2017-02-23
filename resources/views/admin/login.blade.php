<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>Admin Login - GratisBuzz</title>

    <!-- Base Styles -->
    <link href="{{ url('') }}/assets/admin/css/style.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/admin/css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>

<body class="login-body">

    <div class="login-logo">
        {{-- <img src="{{ url('images/event/event_logo_small.png') }}"/> --}}
        <h1 style="color: black">Gratiss Buzz</h1>
    </div>

    <h2 class="form-heading">administrator login</h2>
    <div class="container log-row">
        <form class="form-signin" action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
            @include('partials.errors')
            @include('partials.messages')
            <div class="login-wrap">
                <input type="text" class="form-control" name="username" placeholder="User Name" autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password">
                <button class="btn btn-lg btn-success btn-block" type="submit">LOGIN</button>
                <label class="checkbox-custom check-success">
                    <input type="checkbox" value="remember-me" id="checkbox1"> <label for="checkbox1">Remember me</label>
                    <a class="pull-right" data-toggle="modal" href="#forgotPass"> Forgot Password?</a>
                </label>

            </div>

            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotPass" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="f_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-success" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!--jquery-1.10.2.min-->
    <script src="{{ url('') }}/assets/admin/js/jquery-1.11.1.min.js"></script>
    <!--Bootstrap Js-->
    <script src="{{ url('') }}/assets/admin/js/bootstrap.min.js"></script>
    <script src="{{ url('') }}/assets/admin/js/jrespond..min.js"></script>

</body>
</html>
