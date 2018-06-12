@extends('layouts.subscription')

@section('content')

    <div class="panel-body col-lg-6 col-lg-offset-3">
        <div class="row">

            <div class="form-group clearfix text-center">
                <h2>{{$page_title}}</h2>
            </div>

            <div class="form-group col-lg-12 ">
                <a href="/unsubscribe/step2/{{$tkn}}" class="btn btn-primary  col-lg-12">Unsubscribe me now</a>
            </div>

            <div class="form-group clearfix text-center col-lg-12">
                <a href="/manage-preference/{{$tkn}}" class="btn btn-primary col-lg-12 btn-gray" >May be I want to receive fewer emails</a>
            </div>


        </div>
    </div>
@endsection

