@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')

        {!! Form::model($contactList, ['method' => 'PATCH', 'action'=> ['Admin\ContactListsController@update',$contactList->id], 'enctype'=>'multipart/form-data']) !!}
        @include('admin.contact_lists.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}

    </div>
@endsection

