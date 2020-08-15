<!doctype html>
<html lang="pt" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{__('default.title_web')}}</title>

        <link rel="shortcut icon" href="{{asset('/media/favicons/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/media/favicons/favicon-192x192.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/media/favicons/apple-touch-icon-180x180.png')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/codebase.min.css')}}">

    </head>
    <body>
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container" class="bg-body-dark bg-pattern" style="background-image: url({{asset('/media/various/bg-pattern-inverse.png')}});">

                <!-- Page Content -->
                <div class="hero">
                    <div class="hero-inner">
                        <div class="content content-full">
                            <div class="py-30 text-center">
                                <div class="display-3 text-info">
                                    <i class="fa fa-lock"></i> 401
                                </div>
                                <h1 class="h2 font-w700 mt-30 mb-10">{{__('messages.oops')}} {{__('messages.something_wrong')}}</h1>
                                <h2 class="h3 font-w400 text-muted mb-50">{{__('messages.error_unauthorized')}}</h2>
                                <a class="btn btn-hero btn-rounded btn-alt-primary" href="{{url('home')}}">
                                    <i class="fa fa-arrow-left mr-10"></i> {{__('messages.back_home')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <script src="{{asset('/js/codebase.core.min.js')}}"></script>
        <script src="{{asset('/js/codebase.app.min.js')}}"></script>
    </body>
</html>