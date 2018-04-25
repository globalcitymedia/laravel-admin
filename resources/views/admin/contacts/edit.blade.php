@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')

        {!! Form::model($contact, ['method' => 'PATCH', 'action'=> ['Admin\ContactsController@update',$contact->id], 'enctype'=>'multipart/form-data']) !!}
        @include('admin.contacts.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}


    </div>
@endsection

