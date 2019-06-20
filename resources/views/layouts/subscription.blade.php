<!DOCTYPE html>

<html lang="en">
<head>
@if(env('APP_ENV') == 'production')
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107834739-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-107834739-1');
        </script>
    @endif
    <meta name="google-site-verification" content="nfRqJhDJk90GCaMvwyBzXtsvDBEJh5GGDUwfchaoYzE" />
    <meta charset="utf-8">
    <title>
        {{isset($page_title)?$page_title.' | ':''}}{{config('variables.product_name')}}
    </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/css-reset.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/owl.carousel.min.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/owl.theme.default.min.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/style.css">
    <link type="text/css" rel="stylesheet" href="/theme/basic/css/responsive.css">
    <link rel="icon" type="image/png" href="/storage/images/favicon.jpg" />
    <!-- Styles -->
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/theme/basic/js/jquery-2.2.3.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
    {{--GoogleAnalytics Tracking code--}}

</head>

<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-default">
        <div id="" class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"--}}
                        {{--data-target="#bs-example-navbar-collapse-1" aria-expanded="false">--}}
                    {{--<span class="sr-only">Toggle navigation</span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                {{--</button>--}}
                <a class="navbar-brand" href="{{url('/')}}"><img src="/theme/basic/assets/images/gcm-logo.png" alt=""/></a>
                <a style="padding-top: 50px;" class="navbar-brand" href="#">{{config('variables.company_name')}}</a>
            </div>

        </div><!-- /.container-fluid -->
    </nav>
</header>
<!-- ./Header -->

@if(isset($cover_page) && !is_null($cover_page))
    {{--@if(isset($cover_page) && !is_null($cover_page) && !request::is('/'))    --}}
<div class="hero">
    <img src="{{Storage::disk('public')->url($cover_page)}}" >
</div>

@endif

@if(isset($title) && !request::is('/'))
    <div class="container ">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                @if(isset($breadcrumbs))
                    @foreach($breadcrumbs as $breadcrumb)
                        <li>@if($breadcrumb['url']=='') {{$breadcrumb['title']}} @else<a href="{{$breadcrumb['url']}}">{{$breadcrumb['title']}}</a>@endif</li>
                    @endforeach
                @else
                    <li class="active">{{$title}}</li>
                @endif

            </ol>
        </div>
    </div>

@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@yield('content')



<!-- Footer -->
{{--<footer>--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-6">--}}
                {{--<p class="">Copyright &copy; {{config('variables.company_name')}} {{Date('Y')}}</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}
<!-- ./Footer -->


<!-- JavaScript -->
<script src="/theme/basic/js/bootstrap.min.js"></script>
<script src="/theme/basic/js/owl.carousel.min.js"></script>
<script src="/theme/basic/js/ajax.js"></script>
<script src="/theme/basic/js/main.js"></script>
</body>
</html>


