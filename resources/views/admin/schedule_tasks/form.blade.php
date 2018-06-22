{{--<div class="form-group col-lg-12  form-check">--}}
{{--{!! Form::label('email_template_id', 'Email template') !!}--}}
{{--</div>--}}
{{--@foreach($email_templates as $key => $email_template)--}}
{{--<div class="form-group col-lg-12  form-check">--}}

{{--{{ Form::radio('email_template_id', $key, false) }}--}}
{{--{!! Form::label('email_template_id', $email_template) !!}--}}
{{--</div>--}}
{{--@endforeach--}}


<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('email_template_id', 'Select an email template') !!}
    {!! Form::select('email_template_id',$email_templates,null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">

    {!! Form::label('scheduled_at', 'Schedule at') !!}
    <input class="form-control" name="scheduled_at" type="datetime-local"
           value="{{isset($scheduleTask->scheduled_at)? $scheduleTask->scheduled_at->format('Y-m-d\TH:i') : config('variables.current_datetime')}}"
           id="scheduled_at">
    {{--{!! Form::date('schedule_at', isset($post)? $post['schedule_at']->format('Y-m-d\TH:i') : date('Y-m-d ') ,['class' => 'form-control' ]) !!}--}}
</div>
<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-12  form-check">
    <hr class="col-lg-12">
    {!! Form::label('contact_lists', 'Select at least one contact list') !!}
</div>
@if(isset($scheduleTask))
    <?php $mailinglist = $scheduleTask->contactLists ?>
    @foreach($contact_lists as $contact_list)
        <div class="form-group col-lg-12  form-check">
            {!! Form::checkbox('contact_lists[]', $contact_list->id, $mailinglist->contains($contact_list->id) ? 'true' : null,['class' => 'form-check-input']) !!}
            {!! Form::label('contact_lists', $contact_list->name) !!}
        </div>
    @endforeach
@else
    @foreach($contact_lists as $contact_list)
        <div class="form-group col-lg-12  form-check">
            {!! Form::checkbox('contact_lists[]', $contact_list->id, null ? 'true' : null,['class' => 'form-check-input']) !!}
            {!! Form::label('contact_lists', $contact_list->name) !!}
        </div>
    @endforeach
@endif



<br>&nbsp;
<br>&nbsp;
<br>&nbsp;
<br>
<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>


