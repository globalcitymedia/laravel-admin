@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        @include('errors.list')

        {!! Form::open(['url'=>'admin/contact-lists/'.$selected_contact_list->id.'/contacts', 'enctype'=>'multipart/form-data']) !!}

        @include('admin.contact_list_contacts.form', ['submitButtonText' => 'Create'])

        {!! Form::close() !!}

    </div>

@endsection


