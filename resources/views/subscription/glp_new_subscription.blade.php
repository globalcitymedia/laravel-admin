@extends('layouts.subscription')

@section('content')

    <div class="panel-body col-lg-8 col-lg-offset-1">
        <div class="row">
            <div class="form-group col-lg-12 clearfix text-center">
                <img src="http://www.globallegalpost.com/images/global-legal-post-v1.png" style="align-items: center; width: 100%; max-width: 600px;">
            </div>
            <div class="form-group col-lg-12 clearfix">
                <br>
                <h2 class=""><strong>{{$page_title}}</strong></h2>
                <p>Sign up for our daily/weekly newsletter to get the best of legal articles delivered straight to your
                    inbox.</p>

            </div>
            @include('errors.list')

            {!! Form::open(['url'=>'/glp-subscription', 'enctype'=>'multipart/form-data']) !!}

            @include('subscription.form', ['submitButtonText' => 'Submit'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection


