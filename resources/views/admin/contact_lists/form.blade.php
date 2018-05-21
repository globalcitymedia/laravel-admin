
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('name', 'List name') !!}
    {!! Form::text('name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('display_name', 'Display name') !!}
    {!! Form::text('display_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('type', 'List type') !!}
    {!! Form::select('type',config('variables.contact_list_types'),null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('website', 'Website') !!}
    {!! Form::select('website',config('variables.websites'),null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-lg-12 clearfix">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null ,['class' => 'form-control','rows'=>'2' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('contactfile', 'Contact File') !!}
    {!! Form::file('contactfile', null ,['class' => 'form-control' ]) !!}
</div>
<br>
<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>




<script>
    $(document).ready(function () {
        CKEDITOR.replace('bio');
    });
</script>