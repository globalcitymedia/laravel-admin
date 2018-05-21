<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>{{isset($page_title)?$page_title.' | ':''}}{{config('variables.product_name')}}
        - {{config('variables.company_name')}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="/theme/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/theme/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/theme/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="/theme/basic/assets/images/favicon.png"/>
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

            <a class="navbar-brand" href="{{url('/admin')}}"><img src="/theme/basic/assets/images/gcm-logo.png" alt=""/>
                 {{config('variables.product_name')}}</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="">Contacts</a></li>
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
                    <a href="javascript:;" data-toggle="collapse" data-target="#templates">
                        <i class="fa fa-file" aria-hidden="true"></i> Email Templates <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="templates" class="{{(Request::is('*templates*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/email-templates')}}"> Email Templates</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/email-templates/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New Template</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#scheduletask">
                        <i class="fa fa-file" aria-hidden="true"></i> Schedule tasks <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="scheduletask" class="{{(Request::is('*schedule*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/schedule-tasks')}}"> Schedule Tasks</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/schedule-tasks/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New Schedule Task</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#contact_lists">
                        <i class="fa fa-file" aria-hidden="true"></i> Contact lists <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="contact_lists" class="{{(Request::is('*contact*lists*'))?'':'collapse'}}">
                        <li>
                            <a href="{{url('/admin/contact-lists')}}"> Contact lists</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/contact-lists/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#contacts">
                        <i class="fa fa-file" aria-hidden="true"></i> Contacts <i
                                class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="contacts" class="{{(Request::is('*contacts*'))?'':'collapse'}}">
                        {{--<li>--}}
                            {{--<a href="{{url('/admin/contacts/create')}}"><i class="fa fa-plus" aria-hidden="true"></i>--}}
                                {{--Add New Contact</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{{url('/admin/contacts/')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                All Contacts</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/contacts/no-email-send')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                No email send</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/contacts/email-sent-not-verified')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Email sent, not verified</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/contacts/verified-emails')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                                Verified Emails</a>
                        </li>
                    </ul>
                </li>

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
