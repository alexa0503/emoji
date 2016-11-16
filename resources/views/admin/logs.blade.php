@extends('admin.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>微信日志</h2>
                        <span class="txt"></span>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row">

                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <h5>总次数:{{$count}}</h5>

                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>表情</th>
                                                <th>数量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($logs[0] as $log)
                                            <tr>
                                                <td>{{ $log->value }}</td>
                                                <td>{{ $log->num }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>用户</th>
                                                <th>数量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($logs[1] as $log)
                                            <tr>
                                                <td>{{ $log->value }}</td>
                                                <td>{{ $log->num }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
