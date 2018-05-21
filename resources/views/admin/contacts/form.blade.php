<div class="form-group col-lg-6 clearfix">
    {!! Form::label('first_name', 'First name') !!}
    {!! Form::text('first_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('last_name', 'Last name') !!}
    {!! Form::text('last_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('job_title', 'Job title') !!}
    {!! Form::select('job_title',config('variables.job_titles'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('company', 'Company name') !!}
    {!! Form::text('company', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('country', 'Country') !!}
    {!! Form::select('country',config('variables.countries'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-12  form-check">
    {!! Form::label('contact_lists', 'Contact Lists') !!}
</div>


@foreach($contact_lists as $contact_list)
    <div class="form-group col-lg-12  form-check">
        @if(isset($contact))
            <?php $selected_list = $contact->contactLists ?>
            {!! Form::checkbox('contact_lists[]', $contact_list->id, $selected_list->contains($contact_list->id) ? 'true' : null,['class' => 'form-check-input']) !!}
        @else
            {!! Form::checkbox('contact_lists[]', $contact_list->id, null,['class' => 'form-check-input']) !!}
        @endif

        {!! Form::label('contact_lists', $contact_list->name) !!}
    </div>
@endforeach


<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>
@if(isset($contact))
<div class="container">
    <div class="row panel-body">
        <div class="col-sm-3">
            Email Verified?
        </div>
        <div class="col-sm-9">
            {{$contact->verifiedString()}}
        </div>
        <div class="col-sm-3">
            Last updated
        </div>
        <div class="col-sm-9">
            {{$contact->updated_at->diffForHumans()}}
        </div>
    </div>

</div>
@endif
<div>
    @include('admin.audits.audit')
</div>

<script>
    $(document).ready(function () {
        CKEDITOR.replace('bio');
    });
</script>
