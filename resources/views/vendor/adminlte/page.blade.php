@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{ Auth::user()->contactForm()->count() }}</span>
                          </a>
                          <ul class="dropdown-menu">
                            <li class="header">You have {{ Auth::user()->contactForm()->count() }} messages</li>
                            <li>
                              <!-- inner menu: contains the actual data -->
                              @foreach(Auth::user()->contactForm() as $contact)
                              <ul class="menu">
                                <li><!-- start message -->
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="{{URL::asset('imglogo/logoClinica.png')}}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      {{$contact->name}}
                                      
                                    </h4>
                                    <p>{{$contact->message}}</p>
                                    <p><small><i class="fa fa-clock-o"></i> {{$contact->updated_at->diffForHumans()}} - {{$contact->updated_at->format('d/M/Y')}}</small></p>
                                  </a>
                                </li>
                                <!-- end message -->
                              </ul>
                              @endforeach
                            </li>
                            <li class="footer"><a href="{{url('email/inbox')}}">See All Messages</a></li>
                          </ul>
                        </li>
                      <!-- Tasks: style can be found in dropdown.less -->
                      <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-calendar"></i>
                          <span class="label label-danger">{{ Auth::user()->calendar()->count() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">You have {{ Auth::user()->calendar()->count() }} events</li>
                          <li>
                            @foreach(Auth::user()->calendar() as $calendar)
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                              <li><!-- Task item -->
                                <a href="#">
                                  <h3>
                                    {{$calendar->titulo}}
                                    @php($data_final=Carbon\Carbon::parse($calendar->data_final))
                                    @php($percentag=(strtotime($data_final)/strtotime(today()))*100)
                                    <p><small><i class="fa fa-clock-o"></i> {{$data_final->diffForHumans()}} - {{$data_final->format('d/M/Y')}}</small></p>
                                   
                                  </h3>
                                </a>
                              </li>
                              <!-- end task item -->
                            </ul>
                            @endforeach
                          </li>
                          <li class="footer">
                            <a href="{{url('calendario')}}">View all </a>
                          </li>
                        </ul>
                      </li>
                      <!-- User Account: style can be found in dropdown.less -->
                      <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <img src="{{asset('storage/'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
                          <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <img src="{{asset('storage/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">

                            <p>
                              {{ Auth::user()->name }}
                              <small>Member since {{Auth::user()->created_at}}</small>
                            </p>
                          </li>
                          <!-- Menu Body 
                          <li class="user-body">
                            <div class="row">
                              <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                              </div>
                            </div>
                             /.row -->
                          </li>
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-left">
                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-flat">{{ trans('adminlte::adminlte.log_out') }}</a>
                            </div>
                          </li>
                        </ul>
                      </li>
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @include('notification')

                @yield('content')
             <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                }
            </script>
            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
