<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <!-- zui -->
        <link href="{{ asset('/static/zui/css/zui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/static/css/base.css') }}" rel="stylesheet">
        <link href="{{ asset('/Scripts/pace-1.0.2/themes/blue/pace-theme-flash.css') }}" rel="stylesheet" />
        <link href="{{ asset('/Style/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('/static/zui/lib/datetimepicker/datetimepicker.css') }}" rel="stylesheet" />
        <!--[if lt IE 9]>
            <script src="{{ asset('/static/zui/lib/ieonly/html5shiv.js') }}"></script>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="{{ asset('/static/zui/lib/ieonly/respond.js') }}"></script>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="{{ asset('/static/zui/lib/ieonly/excanvas.js') }}"></script>
        <![endif]-->

    </head>
    <body>
         <!-- header -->
        <header>
            <nav class="navbar navbar-inverse " role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><h1>GeeLogSystem</h1></a>
                </div>
            </nav>
        </header>
        <!-- / header -->
        <div id="left-bar" style="width: 200px">
            <nav class="menu" id="left-menu"  data-toggle="menu" >
                <ul class="nav nav-primary">
                    <li><a href="/index"><i class="icon icon-home"></i>总体</a></li>
                    <li><a href="/zft/1"><i class="icon icon-tablet"></i>pad智付通</a></li>
                    <li><a href="#"><i class="icon icon-phone"></i>转账电话</a></li>
                    <li><a href="#"><i class="icon icon-dashboard"></i>管理端</a></li>
                    <li><a href="#"><i class="icon icon-wrench"></i>协议组件</a></li>
                    <li><a href="/bocom/1"><i class="icon icon-credit"></i>交行</a></li>
                    <li><a href="#"><i class="icon icon-bell-alt"></i>异常</a>
                        <ul class="nav">
                            <li >
                                <a href="/zftexc/1"><i class="icon icon-tablet"></i>pad智付通</a>
                            </li>
                            <li >
                                <a href=""><i class="icon icon-phone"></i>转账电话</a>
                            </li>
                            <li >
                                <a href=""><i class="icon icon-dashboard"></i>管理端</a>
                            </li>
                            <li >
                                <a href=""><i class="icon icon-wrench"></i>协议组件</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/search"><i class="icon icon-search"></i>搜索</a></li>
                    <li><a href="/overall"><i class="icon icon-line-chart"></i></i>总体统计</a></li>
                    <li><a href="/zftsta"><i class="icon icon-area-chart"></i>pad智付通统计</a></li>

                    <li><a href="#"><i class="icon icon-bell-alt"></i>任务管理</a>
                    <ul class="nav">
                        <li >
                            <a href="/taskmanage/1"><i class="icon icon-tablet"></i>任务管理</a>
                        </li>
                        <li >
                            <li><a href="/task/0/1"><i class="icon icon-calendar"></i>任务流水</a></li>
                        </li>

                    </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div id="main-content">
         
            @yield('breadcrumb')
            @yield('content')
        </div>

        <script src="/static/zui/lib/jquery/jquery.js"></script>
        <!-- ZUI Javascript组件 -->
        <script src="/static/zui/js/zui.min.js"></script>
        <script src="/static/lib/layer/layer.js"></script>
        <script src="/Scripts/bootstrap.min.js"></script>
        <script>
            $(function () {
                $('#left-bar').add('#main-content').height($(window).height() - $('header').height());
                $('.header-tooltip').tooltip();
                $('#left-menu ul.nav-primary ul.nav li.active').parents('li').addClass('active show');
            });
        </script>
        @yield('script')
    </body>
</html>