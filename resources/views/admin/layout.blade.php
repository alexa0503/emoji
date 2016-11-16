<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>{{env('PAGE_TITLE')}} - 后台管理</title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Import google fonts - Heading first/ text second -->
    <link href="{{asset('assets/admin/css/font.css')}}" rel='stylesheet' type='text/css'>
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
<body>
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- .page-navbar -->
@include('admin.header')
<!-- / page-navbar -->
<!-- #wrapper -->
<div id="wrapper">
    <!-- .page-sidebar -->
    @include('admin.sidebar')
    <!-- / page-sidebar -->
    <!-- Start #right-sidebar -->
    @include('admin.rightSidebar')
    <!-- End #right-sidebar -->
    <!-- .page-content -->
    @yield('content')
    <!-- / page-content -->
</div>
<!-- / #wrapper -->
@include('admin.footer')
<!-- End #footer  -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>
<!-- Javascripts -->
<!-- Load pace first -->
<script src="{{asset('assets/admin/plugins/core/pace/pace.min.js')}}"></script>
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
<!-- Core plugins ( not remove ) -->
<script src="{{asset('assets/admin/js/libs/modernizr.custom.js')}}"></script>
<!-- Handle responsive view functions -->
<script src="{{asset('assets/admin/js/jRespond.min.js')}}"></script>
<!-- Custom scroll for sidebars,tables and etc. -->
<script src="{{asset('assets/admin/plugins/core/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js')}}"></script>
<!-- Remove click delay in touch -->
<script src="{{asset('assets/admin/plugins/core/fastclick/fastclick.js')}}"></script>
<!-- Increase jquery animation speed -->
<script src="{{asset('assets/admin/plugins/core/velocity/jquery.velocity.min.js')}}"></script>
<!-- Quick search plugin (fast search for many widgets) -->
<script src="{{asset('assets/admin/plugins/core/quicksearch/jquery.quicksearch.js')}}"></script>
<!-- Bootbox fast bootstrap modals -->
<script src="{{asset('assets/admin/plugins/ui/bootbox/bootbox.js')}}"></script>
<!-- Other plugins ( load only nessesary plugins for every page) -->
<script src="{{asset('assets/admin/plugins/charts/sparklines/jquery.sparkline.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.dynamic.js')}}"></script>
<script src="{{asset('assets/admin/plugins/forms/bootstrap-timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{asset('assets/admin/plugins/forms/bootstrap-filestyle/bootstrap-filestyle.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.form.js')}}"></script>
<script src="{{asset('assets/admin/plugins/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<script src="{{asset('assets/admin/js/pages/blank.js')}}"></script>

@yield('scripts')
<script>
    $().ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*
        $.get('/admin/user/logs',function (data) {
            $('#userLogs').html(data);
        });
        */
        $('.side-nav .nav li ul li').each(function(){
            if( $(this).find('a').hasClass('active')){
                $(this).parent('ul').addClass('show');
                $(this).parent('ul').parent('li').find('a').eq(0).addClass('expand').addClass('active-state');
            }

        });
    })
</script>
</body>
</html>
