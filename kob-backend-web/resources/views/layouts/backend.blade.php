<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{__('default.title_web')}}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/logo/icon') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/logo/icon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/logo/icon') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/codebase.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/platform.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ asset('/css/themes/corporate.css') }}">     
        <link rel="stylesheet" src="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}"/>        
        @yield('css_after')
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>        
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>                

    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed enable-cookies">
            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15" style="border-bottom: 1px solid #525252">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">K</span><span class="text-primary">B</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="pb-5" href="/dashboard">
                                    <img src="{{ asset('media/logo/logo-larger.png') }}" style="width:147px;" alt="">

                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full mt-5">
                        <ul class="nav-main m-0" style="font-size:19px;">
                            <li>
                                <a class="{{ request()->is('home') ? ' active' : '' }}" href="/home">
                                    <i class="fas fa-tachometer-alt"></i><span class="sidebar-mini-hide">Dashboard</span>
                                </a>
                            </li>
                            @if(AccessSession::getAccessId())                               
                            <li>
                                <a class="{{ request()->is('tickets') ? ' active' : '' }}" href="/tickets">
                                    <i class="fas fa-ticket-alt"></i><span class="sidebar-mini-hide">{{__('ticket.page_title')}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('service_types') ? ' active' : '' }}" href="/service_types">
                                    <i class="fas fa-book-open"></i><span class="sidebar-mini-hide">{{__('service_type.page_title')}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('workspace_accesses') ? ' active' : '' }}" href="/workspace_accesses">
                                    <i class="fa fa-users"></i></i><span class="sidebar-mini-hide">{{__('access.page_title')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="signout_workspace">
                                    <i class="fas fa-sign-out-alt"></i><span class="sidebar-mini-hide">{{__('default.exit')}}</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->is_admin)
                            <li>
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-user"></i><span class="sidebar-mini-hide">{{__('default.super_admin')}}</span></a>
                                <ul>
                                    <li>
                                        <a  href="/workspaces">
                                            {{__('workspace.page_title')}}
                                        </a>
                                    </li> 
                                    <li>
                                        <a class="{{ request()->is('users') ? ' active' : '' }}" href="/users">
                                            {{__('user.page_title')}}
                                        </a>
                                    </li>    
                                </ul>
                            </li>
                            @endif

                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header" style="border-bottom: 1px solid rgba(0,0,0,.1);">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary open-sidebar" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                            
                        <label class="page-title nav-color" for="title_page">@yield('title')@if(AccessSession::getAccessId()) - {{__('default.company')}} {{AccessSession::getWorkspaceName()}} @endif </label>

                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">                        
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary nav-color" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">{{Auth::user()->name}}</span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">{{Auth::user()->role}}</h5>
                                <a class="dropdown-item" href="/users/profile">
                                    <i class="si si-user mr-5"></i> {{__('auth.profile')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="si si-logout mr-5"></i> {{__('auth.signout')}}
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->



                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                   </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <div class="content mt-5">
                    @yield('content')
                </div>
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        {{__('default.footer_crafted_msg')}} <a class="font-w600" href="https://formasites.com.br" target="_blank">FormaSites</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://kingofblacks.com" target="_blank">{{__('default.title_web')}}</a> &copy; <span class="js-year-copy"></span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ asset('js/codebase.app.js') }}"></script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAabyf32b4Uaij8a_se0udwl2JwkebIAvg&libraries=places&callback=initMap" async="" defer=""></script>
        <!-- Laravel Scaffolding JS -->
        <!--<script src="{{ asset('js/laravel.app.js') }}"></script>-->
        <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

        @yield('js_after')

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form> 
    </body>   
@if (session('error'))
    <script>
        swal({
          icon: 'warning',
          title: "{{__('messages.oops')}}",
          text: "{{session('error')}}",
        })
    </script>
@endif 
</html>
