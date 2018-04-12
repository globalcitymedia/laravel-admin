@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')
        {!! Form::model($user , ['method' => 'PATCH', 'action'=> ['Admin\AdminUsersController@update',$user->id]]) !!}
        @include('admin.admin_users.form', ['submitButtonText' => 'Update user'])

        {!! Form::close() !!}

    </div>
@endsection





