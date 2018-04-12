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
    <title>{{ (isset($title)?$title.' | ':'') }} Herbie & Co</title>
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}"><img src="/theme/basic/assets/images/herbie-logo.png" alt=""/></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class=" @if(Request::is('*options*')) active @endif">
                        <a href="{{url('/membership-options')}}"  class="dropdown-toggle" data-toggle="dropdown">Membership Options <span class="caret"></span></a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/why-become-a-member/')}}">Why Become a Member</a></li>
                            <li><a href="{{url('/corporate-individual/')}}">Corporate & Individual</a></li>
                            <li><a href="{{url('/levels-of-membership/')}}">Levels of Membership</a></li>
                        </ul>


                    </li>
                     <li class=" @if(Request::is('*benefits*')) active @endif">
                        <a href="{{url('/membership-benefits')}}"  class="dropdown-toggle" data-toggle="dropdown">Membership Benefits <span class="caret"></span></a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/membership-benefits/')}}">Membership Benefits</a></li>
                            <li><a href="{{url('/partners/')}}">Partners</a></li>
                        </ul>


                    </li>

                    <li class="@if(Request::is('*about*')) active @endif"><a href="{{url('/about')}}">About</a></li>
                    <li class="@if(Request::is('*contact*')) active @endif"><a href="{{url('/contact')}}">Contact</a></li>
                    {{--<li class="@if(Request::is('*contact*')) active @endif"><a href="{{url('/contact')}}">Contact</a></li>--}}



                    @if (!Auth::guest())

                        <li >
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                @if(Auth::user()->isAdmin())
                                    <li><a href="{{url('/admin')}}">Admin</a></li>
                                @endif

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div><!-- /.navbar-collapse -->
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

@yield('content')



<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <p class="">Copyright &copy; {{config('variables.company_name')}} {{Date('Y')}}</p>
                <p class="">79 College Road, Harrow, Middlesex, England, HA1 1BD.</p>
                <p><a href="/en/term-pages/terms-and-conditions">Terms &amp; Conditions</a>&nbsp;| <a href="/en/term-pages/privacy-policy1">Privacy Policy</a></p>
                {{--<div class="footer-social pull-left">--}}
                    {{--<a href="{{config('variables.twitter')}}" target="_blank"><i class="fa fa-twitter"></i></a>--}}
                    {{--<a href="{{config('variables.linkedin')}}" target="_blank"><i class="fa fa-linkedin"></i></a>--}}
                    {{--<a href="{{config('variables.instagram')}}" target="_blank"><i class="fa fa-instagram"></i></a>--}}
                {{--</div>--}}
            </div>

            <div class="col-sm-4 pull-right">
                <div class="footer-logo">
                    <img src="/theme/basic/assets/images/abta-logo.png" alt=""/>
                </div>
            </div>


        </div>
    </div>
</footer>
<!-- ./Footer -->


<!-- JavaScript -->
<script src="/theme/basic/js/bootstrap.min.js"></script>
<script src="/theme/basic/js/owl.carousel.min.js"></script>
<script src="/theme/basic/js/ajax.js"></script>
<script src="/theme/basic/js/main.js"></script>
</body>
</html>


