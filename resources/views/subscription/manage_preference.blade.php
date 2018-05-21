@extends('layouts.subscription')

@section('content')

    <div class="panel-body">

        <div class="form-group col-lg-12 clearfix">
            <h2>Manage Preference</h2>
        </div>

        @include('errors.list')

        {!! Form::model($contact , ['method' => 'PATCH', 'action'=> ['ManageUserPreferenceController@update',encrypt($tkn)]]) !!}
        @include('subscription.form', ['submitButtonText' => 'Update user'])

        {!! Form::close() !!}
    </div>

@endsection

