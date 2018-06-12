


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

<div class="form-group col-lg-12 ">
    <h4><strong>Frequency of updates</strong></h4>
</div>

@foreach($contact_lists as $contact_list)
    <div class="form-group col-lg-12  form-check">
        @if(isset($contact))
            <?php $selected_list = $contact->contactLists ?>
            {!! Form::checkbox('contact_lists[]', $contact_list->id, $selected_list->contains($contact_list->id) ? 'true' : null,['class' => 'form-check-input']) !!}
        @else
            {!! Form::checkbox('contact_lists[]', $contact_list->id, null,['class' => 'form-check-input']) !!}
        @endif

        {!! Form::label('contact_lists',$contact_list->name) !!}
        <p style="font-weight: normal;">{{$contact_list->description}}</p>
    </div>
@endforeach


<div class="form-group col-lg-12 ">
    <p>All email updates are free of charge.</p>
</div>


<div class="form-group clearfix col-lg-12">
    @if(isset($tkn))
        <input type="hidden" name="tkn" value="{{$tkn}}">
    @endif

    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>

