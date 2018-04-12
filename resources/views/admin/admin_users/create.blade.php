@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')

        <div class="panel-body">
            {!! Form::open(['url'=>'admin/admin_users']) !!}

            <div class="form-group col-lg-6">
                {!! Form::label('first_name', 'First name') !!}
                {!! Form::text('first_name', null ,['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('last_name', 'Last name') !!}
                {!! Form::text('last_name', null ,['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('email', 'email') !!}
                {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password',['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                {!! Form::password('password_confirmation',['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('status', 'Status') !!}
                {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-lg-12">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control' ]) !!}
            </div>

            {!! Form::close() !!}

        </div>
@endsection


