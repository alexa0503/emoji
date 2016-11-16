@extends('layouts.admin')

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
                            <div class="panel-body pt0 pb0">
                                <form id="validate" class="form-horizontal group-border stripped" role="form" action="{{url('admin/account')}}" method="post">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">账户名</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input id="text" type="text" class="form-control disabled" value="{{request()->user()->name}}" disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-lg-2 col-md-3 control-label">Email</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input id="email" name="email" type="email" class="form-control disabled" placeholder="" value="{{request()->user()->email}}" disabled="true">
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-lg-2 col-md-3 control-label">密码</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="输入密码">
                                            @if ($errors->has('password'))
                                                <label id="password-error" class="help-block" for="password">{{ $errors->first('password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('repeat-password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-lg-2 col-md-3 control-label">重复密码</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="输入重复密码">
                                            @if ($errors->has('repeat-password'))
                                                <label id="password-error" class="help-block" for="repeat-password">{{ $errors->first('repeat-password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <div class="col-lg-offset-2">
                                            <button class="btn btn-default ml15" type="submit">提 交</button>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                </form>
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
