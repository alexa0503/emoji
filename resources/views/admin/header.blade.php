<div id="header" class="page-navbar">
    <!-- .navbar-brand -->
    <a href="{{route('admin_dashboard')}}" class="navbar-brand hidden-xs hidden-sm">
        <img src="{{asset('assets/admin/img/logo.png')}}" class="logo hidden-xs" alt="O.M.P.">
        <img src="{{asset('assets/admin/img/logosm.png')}}" class="logo-sm hidden-lg hidden-md" alt="O.M.P.">
    </a>
    <!-- / navbar-brand -->
    <!-- .no-collapse -->
    <div id="navbar-no-collapse" class="navbar-no-collapse">
        <!-- top left nav -->
        <ul class="nav navbar-nav">
            <li class="toggle-sidebar">
                <a href="#">
                    <i class="fa fa-reorder"></i>
                    <span class="sr-only">Collapse sidebar</span>
                </a>
            </li>
            <li>
                <a href="#" class="reset-layout tipB" title="Reset panel position for this page"><i class="fa fa-history"></i></a>
            </li>
        </ul>
        <!-- / top left nav -->
        <!-- top right nav -->
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{url('/admin/account')}}">
                    <span>{{Auth::guard('admin')->user()->name}}, Welcome</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="index.html#" data-toggle="dropdown">
                    <i class="fa fa-language"></i>
                    <span class="sr-only">语言</span>
                </a>
                <ul class="dropdown-menu right dropdown-notification" role="menu">
                    <li>
                        <a href="index.html#" class="dropdown-menu-header">语言选择</a>
                    </li>
                    <li>
                        <a href="{{url('/_locale',['locale'=>'en','url'=>base64_encode(Request::getUri())])}}">@if (App::getLocale() == 'en')<i class="fa fa-check-square-o"></i>@else <i class="fa fa-square-o"></i> @endif 英文</a>
                    </li>
                    <li>
                        <a href="{{url('/_locale',['locale'=>'zh-cn','url'=>base64_encode(Request::getUri())])}}">@if (App::getLocale() == 'zh-cn')<i class="fa fa-check-square-o"></i>@else <i class="fa fa-square-o"></i> @endif 中文</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                    <span class="sr-only">Settings</span>
                </a>
                <ul class="dropdown-menu dropdown-form dynamic-settings right" role="menu">
                    <li>
                        <a href="#" class="dropdown-menu-header">Template settings</a>
                    </li>
                    <li>
                        <div class="toggle-custom">
                            <label class="toggle" data-on="ON" data-off="OFF">
                                <input type="checkbox" id="fixed-header-toggle" name="fixed-header-toggle" checked>
                                <span class="button-checkbox"></span>
                            </label>
                            <label for="fixed-header-toggle">Fixed header</label>
                        </div>
                    </li>
                    <li>
                        <div class="toggle-custom">
                            <label class="toggle" data-on="ON" data-off="OFF">
                                <input type="checkbox" id="fixed-left-sidebar" name="fixed-left-sidebar" checked>
                                <span class="button-checkbox"></span>
                            </label>
                            <label for="fixed-left-sidebar">Fixed Left Sidebar</label>
                        </div>
                    </li>
                    <li>
                        <div class="toggle-custom">
                            <label class="toggle" data-on="ON" data-off="OFF">
                                <input type="checkbox" id="fixed-right-sidebar" name="fixed-right-sidebar" checked>
                                <span class="button-checkbox"></span>
                            </label>
                            <label for="fixed-right-sidebar">Fixed Right Sidebar</label>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/admin/logout')}}">
                    <i class="fa fa-power-off"></i>
                    <span class="sr-only">Logout</span>
                </a>
            </li>
            <li>
                <a id="toggle-right-sidebar" href="#" class="tipB" title="Toggle right sidebar">
                    <i class="l-software-layout-sidebar-right"></i>
                    <span class="sr-only">Toggle right sidebar</span>
                </a>
            </li>
        </ul>
        <!-- / top right nav -->
    </div>
    <!-- / collapse -->
</div>
