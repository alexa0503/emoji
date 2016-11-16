@extends('admin.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>授权用户</h2>
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
                                <table id="basic-datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>头像</th>
                                        <th>ID/昵称</th>
                                        <th>国家</th>
                                        <th>省份/城市</th>
                                        <th>授权时间</th>
                                        <th>授权IP</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($wechat_users as $user)
                                    <tr>
                                    <td>{{ $user->id }}</td>
                                        <td><img title="{{$user->open_id}}" class="img-thumbnail" width="100" height="100" src="{{ $user->head_img }}" /></td>
                                        <td>{{ json_decode($user->nick_name) }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>{{ $user->province }}/{{ $user->city }}</td>
                                        <td>{{ $user->create_time }}</td>
                                        <td>{{ $user->create_ip }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $wechat_users->links() !!}
                                        </div>
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
