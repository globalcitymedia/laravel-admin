@extends('layouts.subscription')

@section('content')

    <div class="panel-body">

        <div class="form-group col-lg-12 clearfix">
            <h2>Newsletter subscription</h2>
            <p>Sign up for our daily/weekly newsletter to get the best of legal articles delivered straight to your inbox.</p>

        </div>

        @include('errors.list')

        {!! Form::open(['url'=>'/glp-subscription', 'enctype'=>'multipart/form-data']) !!}

        @include('subscription.form', ['submitButtonText' => 'Submit'])

        {!! Form::close() !!}

    </div>

@endsection


