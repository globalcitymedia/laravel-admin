{!! Form::open(['url'=>'/admin/contacts/search', 'enctype'=>'multipart/form-data']) !!}
<div class="form-group col-lg-4 clearfix">
    {!! Form::text('search', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group clearfix col-lg-2">
    {!! Form::submit('Search', ['class' => 'btn btn-primary form-control' ]) !!}
</div>
{!! Form::close() !!}