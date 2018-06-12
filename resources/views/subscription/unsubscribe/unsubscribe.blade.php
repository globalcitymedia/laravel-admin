@extends('layouts.subscription')

@section('content')

    <div class="panel-body">

        <div class="form-group col-lg-12 clearfix">
            <h2>{{$page_title}}</h2>
        </div>

        @include('errors.list')

        {!! Form::model($contact , ['method' => 'PATCH', 'action'=> ['ManageUserPreferenceController@updateManagePreference',$contact->id]]) !!}
        @include('subscription.unsubscribe.form', ['submitButtonText' => 'Update user'])

        {!! Form::close() !!}
    </div>

@endsection

