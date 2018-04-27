
<div class="form-group col-lg-12 clearfix">
    {!! Form::label('name', 'List name') !!}
    {!! Form::text('name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-12 clearfix">
    {!! Form::label('contactfile', 'Contact File') !!}
    {!! Form::file('contactfile', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>


<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>




<script>
    $(document).ready(function () {
        CKEDITOR.replace('bio');
    });
</script>