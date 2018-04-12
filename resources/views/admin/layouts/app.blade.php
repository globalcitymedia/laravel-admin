<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>{{isset($page_title)?$page_title.' | ':''}}{{config('variables.product_name')}} Admin
        - {{config('variables.company_name')}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="/theme/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/theme/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/theme/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="/theme/arcs3/assets/images/favicon.png"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--ckeditor-->
    <script src="/theme/admin/js/jquery.js"></script>
    <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{url('/')}}"><img src="/theme/basic/assets/images/herbie-logo.png" alt=""/>
                {{-- {{config('variables.product_name')}} Admin--}}</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-user"></i> {{ Auth::user()->name() }}<b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>

                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off"></i> Log Out</a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">


                <li>
                    <a href="{{url('/admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#pages"><i
                                class="fa fa-fw fa-file"></i> Pages <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="pages" class="{{(Request::is('*pages*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/pages')}}"> All Pages</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/pages/create')}}">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#segments"><i
                                class="fa fa-fw fa-file"></i> Segments <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="segments" class="{{(Request::is('*segments*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/segments')}}"> All Segments</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/segments/create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#images">
                        <i class="fa fa-fw fa-picture-o"></i> Images <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="images" class="{{(Request::is('*images*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/images')}}"> All Images</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/images/create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#carousels">
                        <i class="fa fa-file" aria-hidden="true"></i> Carousels <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="carousels" class="{{(Request::is('*documents*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/carousels')}}"> All Carousels</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/carousels/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#documents">
                        <i class="fa fa-file" aria-hidden="true"></i> Documents <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="documents" class="{{(Request::is('*documents*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/documents')}}"> All Documents</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/documents/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#testimonials">
                        <i class="fa fa-quote-left" aria-hidden="true"></i> Testimonials <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="testimonials" class="{{(Request::is('*testimonials*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/testimonials')}}"> All Testimonials</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/testimonials/create')}}">Add New</a>
                        </li>
                    </ul>
                </li>

                {{--<li>--}}
                {{--<a href="javascript:;" data-toggle="collapse" data-target="#authors">--}}
                {{--<i  class="fa fa-fw fa-user"></i> Authors <i class="fa fa-fw fa-caret-down"></i></a>--}}
                {{--<ul id="authors" class="{{(Request::is('*authors*'))?'':'collapse'}}">--}}
                {{--<li>--}}
                {{--<a href="{{url('/admin/authors')}}"> All Authors</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="{{url('/admin/authors/create')}}">Add New</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#admin_users">
                        <i class="fa fa-fw fa-wrench"></i> Admin Users <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="admin_users" class="{{(Request::is('*admin_users*'))?'':'collapse'}}">
                        <li>
                            <a href="/admin/admin_users"> All Admin Users</a>
                        </li>
                        <li>
                            <a href="/admin/admin_users/create"><i class="fa fa-plus" aria-hidden="true"></i> Add
                                New</a>
                        </li>

                    </ul>
                </li>


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    @yield('content')


</div>
<!-- /#wrapper -->

<!-- jQuery -->
{{--<script src="/theme/admin/js/jquery.js"></script>--}}

<!-- Bootstrap Core JavaScript -->
<script src="/theme/admin/js/bootstrap.min.js"></script>
<script src="/theme/admin/js/admin.js"></script>
</body>

</html>
