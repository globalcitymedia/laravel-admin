<div class="form-group col-lg-6">
    {!! Form::label('first_name', 'First name') !!}
    {!! Form::text('first_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6">
    {!! Form::label('last_name', 'Last name') !!}
    {!! Form::text('last_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6">
    {!! Form::label('email', 'email') !!}
    {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password',['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>