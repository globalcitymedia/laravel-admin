@extends('layouts.subscription')

@section('content')
    <div class="container">
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 offset-md-6">
                <div class="card">
                    @if($verified)
                    <div class="alert alert-success">
                        <h1>Congratulations!</h1>
                        <br>

                        <p>You have successfully verified your email!</p>
                        <br>
                        <p>Global City Media</p>
                    </div>
                    @else
                    <div class="alert alert-success">
                        <h1>Ooops!!</h1>
                        <br>
                        <p>Something went wrong. Please try again.</p>
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

@endsection