@include('admin.contact_lists.contact_list')

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
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group clearfix col-lg-12">
    {!! Form::hidden('selected_contact_list_id', $selected_contact_list->id) !!}
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}

</div>


<script>
    $(document).ready(function () {
        CKEDITOR.replace('bio');
    });
</script>