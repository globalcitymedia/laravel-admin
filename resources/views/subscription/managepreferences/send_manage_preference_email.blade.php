@extends('layouts.subscription')

@section('content')

    <div class="panel-body col-lg-6 col-lg-offset-1 border-info">
        <div class="row">
            {{--<div class="form-group col-lg-12 clearfix text-center">--}}
                {{--<img src="http://www.globallegalpost.com/images/global-legal-post-v1.png" style="align-items: center; width: 100%; max-width: 600px;">--}}
            {{--</div>--}}
            <div class="form-group col-lg-12 clearfix">
                <br>
                <h2 class=""><strong>{{$page_title}}</strong></h2>
                <p></p>
            </div>
            @include('errors.list')

            {!! Form::open(['url'=>'/send-email-to-manage-preferences', 'enctype'=>'multipart/form-data']) !!}

            <div class="form-group col-lg-12">
                {!! Form::label('email', 'Please enter your email') !!}
                {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
            </div>
            <div class="form-group col-lg-12">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control' ]) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
