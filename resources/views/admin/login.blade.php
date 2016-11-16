<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>登录 | 后台管理系统</title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />
    <!-- Import google fonts - Heading first/ text second -->
    <link href='{{asset('assets/admin/css/font.css')}}' rel='stylesheet' type='text/css'>
    <!-- Css files -->
    <!-- Icons -->
    <link href="{{asset('assets/admin/css/icons.css')}}" rel="stylesheet" />
    <!-- Bootstrap stylesheets (included template modifications) -->
    <link href="{{asset('assets/admin/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- Plugins stylesheets (all plugin custom css) -->
    <link href="{{asset('assets/admin/css/plugins.css')}}" rel="stylesheet" />
    <!-- Main stylesheets (template main css file) -->
    <link href="{{asset('assets/admin/css/main.css')}}" rel="stylesheet" />
    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet" />
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="msapplication-TileColor" content="#3399cc" />
</head>
<body class="login-page">
<!-- Start login container -->
<div class="container login-container">
    <div class="login-panel panel panel-default plain animated bounceIn">
        <!-- Start .panel -->
        <div class="panel-heading">
            <h4 class="panel-title text-center">
                <!--<img id="logo" src="{{asset('assets/admin/img/logo-dark.png')}}"alt="Dynamic logo">-->
                {{env('PAGE_TITLE')}} - 后台管理
            </h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal mt0" method="post" action="{{ url('/admin/login') }}" id="login-form" role="form">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-lg-12">
                        <div class="input-group input-icon">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="您的Email ...">
                            @if ($errors->has('email'))
                                <label id="email-error" class="help-block" for="email">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-lg-12">
                        <div class="input-group input-icon">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="password" id="password" class="form-control" value="" placeholder="您的密码">
                            @if ($errors->has('password'))
                                <label id="password-error" class="help-block" for="password">{{ $errors->first('password') }}</label>
                            @endif
                        </div>
                        <span class="help-block text-right"><a href="login.html#">忘记密码 ?</a></span>
                    </div>
                </div>
                <div class="form-group mb0">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                        <div class="checkbox-custom">
                            <input type="checkbox" name="remember" id="remember" value="option">
                            <label for="remember">记住我 ?</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25">
                        <button class="btn btn-default pull-right" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- End .panel -->
</div>
<!-- End login container -->
<div class="container">
    <div class="footer">
        <p class="text-center">&copy;2016 Copyright Alexa. All right reserved !!!</p>
    </div>
</div>
<!-- Javascripts -->
<!-- Important javascript libs(put in all pages) -->
<script src="{{asset('assets/admin/js/jquery-2.1.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery-ui.js')}}"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('assets/admin/js/libs/excanvas.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/html5.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/libs/respond.min.js')}}"></script>
<![endif]-->
<!-- Bootstrap plugins -->
<script src="{{asset('assets/admin/js/bootstrap/bootstrap.js')}}"></script>
<!-- Form plugins -->
<script src="{{asset('assets/admin/plugins/forms/validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/admin/plugins/forms/validation/additional-methods.min.js')}}"></script>
<!-- Init plugins olny for this page -->
<script src="{{asset('assets/admin/js/pages/login.js')}}"></script>

</body>
</html>
