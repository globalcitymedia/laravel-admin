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
                    <h3 >
                       Welcome back {{Auth::user()->name()}}!!
                        <?php
                        //phpinfo();
                        ?>
                    </h3>
                </div>
            </div>
            <!-- /.row -->



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

@endsection
