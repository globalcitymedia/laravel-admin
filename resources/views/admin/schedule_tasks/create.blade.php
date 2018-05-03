@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        @include('errors.list')

        {!! Form::open(['url'=>'admin/schedule-tasks', 'enctype'=>'multipart/form-data']) !!}

        @include('admin.schedule_tasks.form', ['submitButtonText' => 'Create'])

        {!! Form::close() !!}

    </div>

@endsection


