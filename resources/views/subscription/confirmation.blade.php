@extends('layouts.subscription')

@section('content')
    <div class="container">
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 offset-md-6">
                <div class="card">
                    <div class="alert alert-success">
                        <h1>Congratulations!</h1>
                        <br>

                        <p>{{$msg}}</p>
                        <br>
                        <p>Global City Media</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
