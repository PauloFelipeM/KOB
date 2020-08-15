<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{__('default.title_web')}}</title>

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/logo/icon') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/logo/icon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/logo/icon') }}">
        
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/codebase.min.css')}}">

    </head>
    <body>

        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">                
                @yield('content')
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
 
        <script src="{{asset('/js/codebase.core.min.js')}}"></script>
        <script src="{{asset('/js/codebase.app.min.js')}}"></script>
        <!-- Page JS Plugins -->
        <script src="{{asset('/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <!-- Page JS Code -->
        <script src="{{asset('/js/auth/op_auth_signin.min.js')}}"></script>
    </body>    
</html>