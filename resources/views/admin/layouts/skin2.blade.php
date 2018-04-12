@extends('admin.layouts.app')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.layouts.pageheader')
                </div>
            </div>
            <!-- /.row -->

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    @yield('body')

                </div>
            </div>
            <!-- /.row -->



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->










@endsection