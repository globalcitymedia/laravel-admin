@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')

        {!! Form::model($emailTemplate, ['method' => 'PATCH', 'action'=> ['Admin\EmailTemplateController@update',$emailTemplate->id], 'enctype'=>'multipart/form-data']) !!}
        @include('admin.email_templates.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}

    </div>
@endsection

