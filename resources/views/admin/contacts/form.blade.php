<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('first_name', 'First name') !!}
    {!! Form::text('first_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('last_name', 'Last name') !!}
    {!! Form::text('last_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
</div>
<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('work_type', 'Job title') !!}
    {!! Form::select('work_type',config('variables.work_type'),null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('job_title', 'Job title') !!}
    {!! Form::text('job_title',null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('company', 'Company name') !!}
    {!! Form::text('company', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('country', 'Country') !!}
    {!! Form::select('country',config('variables.countries'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-lg-4 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-6 col-lg-4">
    {!! Form::label('renewal_date', 'Renewal Date') !!}
    <input class="form-control" name="renewal_date" type="datetime-local"
           value="{{isset($contact->renewal_date)? $contact->renewal_date->format('Y-m-d\TH:i') : config('variables.renewal_date')}}"
           id="scheduled_at">
    {{--{!! Form::date('schedule_at', isset($post)? $post['schedule_at']->format('Y-m-d\TH:i') : date('Y-m-d ') ,['class' => 'form-control' ]) !!}--}}
</div>
<div class="form-group col-md-8 col-lg-8  form-check">
    {!! Form::label('contact_lists', 'Contact Lists') !!}



@foreach($contact_lists as $contact_list)
    <div class="form-group col-md-12 form-check">
        @if(isset($contact))
            <?php $selected_list = $contact->contactLists ?>
            {!! Form::checkbox('contact_lists[]', $contact_list->id, $selected_list->contains($contact_list->id) ? 'true' : null,['class' => 'form-check-input']) !!}
        @else
            {!! Form::checkbox('contact_lists[]', $contact_list->id, null,['class' => 'form-check-input']) !!}
        @endif

        {!! Form::label('contact_lists', $contact_list->name) !!}
    </div>
@endforeach
</div>
@if(isset($contact))
    <div class="form-group col-md-4 col-lg-4 bg-info form-check">
        <div class="row panel-body">
            <div class="col-sm-12">
                <b>Email Verified?:</b>
            </div>
            <div class="col-sm-12">
                {{$contact->verifiedString()}}
            </div>
            <div class="col-sm-12">
                <b>Last updated:</b>
            </div>
            <div class="col-sm-12">
                {{$contact->updated_at->diffForHumans()}}
            </div>
        </div>

    </div>
@endif

<div class="form-group clearfix col-lg-6 col-lg-offset-3">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>
{{--<div class="form-group clearfix col-lg-12">--}}
    {{--<a href="" class="btn btn-info col-sm-6 col-lg-4">View Sent Emails</a>--}}
{{--</div>--}}
<div>
    @include('admin.audits.audit')
</div>

<script>
    $(document).ready(function () {
        CKEDITOR.replace('bio');
    });
</script>
