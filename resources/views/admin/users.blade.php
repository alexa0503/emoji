@extends('admin.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>账户管理</h2>
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
                                        <th>账户名</th>
                                        <th>Email</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $users->links() !!}
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
