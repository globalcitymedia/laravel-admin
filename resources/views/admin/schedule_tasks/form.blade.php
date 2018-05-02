
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('name', 'Template name') !!}
    {!! Form::text('name', null ,['class' => 'form-control' ]) !!}
</div>
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('subject', 'Subject') !!}
    {!! Form::text('subject', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('from_address', 'From address') !!}
    {!! Form::text('from_address', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('display_name', 'Display name') !!}
    {!! Form::text('display_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-12 clearfix">
    {!! Form::label('email_body', 'Email body') !!}
    {!! Form::textarea('email_body', null ,['class' => 'form-control' ]) !!}
</div>


<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>


<script>
    $(document).ready(function () {
        CKEDITOR.replace('email_body');
    });
</script>