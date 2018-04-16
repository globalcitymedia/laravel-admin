@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        @include('errors.list')

        {!! Form::open(['url'=>'admin/contacts', 'enctype'=>'multipart/form-data']) !!}

        @include('admin.contacts.form', ['submitButtonText' => 'Create'])

        {!! Form::close() !!}

    </div>

@endsection


