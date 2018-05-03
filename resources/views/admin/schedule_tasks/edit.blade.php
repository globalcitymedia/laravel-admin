@extends('admin.layouts.skin2')

@section('body')

    <div class="panel-body">

        <!-- partials -->
        @include('errors.list')

        {!! Form::model($scheduleTask, ['method' => 'PATCH', 'action'=> ['Admin\ScheduleTaskController@update',$scheduleTask->id], 'enctype'=>'multipart/form-data']) !!}
        @include('admin.schedule_tasks.form', ['submitButtonText' => 'Update'])

        {!! Form::close() !!}

    </div>
@endsection

