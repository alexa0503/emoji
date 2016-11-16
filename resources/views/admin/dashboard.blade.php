@extends('admin.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>控制面板首页</h2>
                        <span class="txt">点击左侧菜单查看详细</span>
                    </div>
                    <div class="header-stats">
                        <div class="spark clearfix">
                        </div>
                        <!--<div class="spark clearfix">
                            <div class="spark-info"><span class="number">17345</span>Views</div>
                            <div id="spark-templateviews" class="sparkline"></div>
                        </div>
                        <div class="spark clearfix">
                            <div class="spark-info"><span class="number">3700$</span>Sales</div>
                            <div id="spark-sales" class="sparkline"></div>
                        </div>-->
                    </div>
                </div>
                <!-- Start .row -->
                <div class="row" style="text-align: center;">
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
@section('scripts')
    <script>
        $().ready(function () {
            $('#spark-visitors').sparkline([5,8,10,8,7,12,11,6,13,8,5,8,10,11,7,12,11,6,13,8], {
                type: 'bar',
                width: '100%',
                height: '20px',
                barColor: '#dfe2e7',
                zeroAxis: false,
            });
        })
    </script>
@endsection
