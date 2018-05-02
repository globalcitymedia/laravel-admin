@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        @include('errors.list')

        {!! Form::open(['url'=>'admin/email-templates', 'enctype'=>'multipart/form-data']) !!}

        @include('admin.email_templates.form', ['submitButtonText' => 'Create'])

        {!! Form::close() !!}

    </div>

@endsection


