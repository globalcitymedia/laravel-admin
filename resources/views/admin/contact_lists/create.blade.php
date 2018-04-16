@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        @include('errors.list')

        {!! Form::open(['url'=>'admin/contact-lists', 'enctype'=>'multipart/form-data']) !!}

        @include('admin.contact_lists.form', ['submitButtonText' => 'Create'])

        {!! Form::close() !!}

    </div>

@endsection


