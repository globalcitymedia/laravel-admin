@extends('layouts.subscription')

@section('content')

    <div class="panel-body col-lg-8 col-lg-offset-1">
        <div class="row">

            <div class="form-group col-lg-12 clearfix">
                <h2>Manage Preference</h2>
            </div>

            @include('errors.list')

            {!! Form::model($contact , ['method' => 'PATCH', 'action'=> ['ManageUserPreferenceController@updateManagePreference',$contact->id]]) !!}
            @include('subscription.managepreferences.form', ['submitButtonText' => 'Update my preferences'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection

