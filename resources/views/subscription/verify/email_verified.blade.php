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

                            <h1>Activate Registration</h1>
                            <br>

                            <p>Thank you. You have successfully validated your email address.</p>
                            <br>
                            <a href="/manage-preference/{{$tkn}}">View preferences</a>

                            <p>Global City Media</p>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h1>Whoops!</h1>
                            <br>
                            <p>Something went wrong. Please try again.</p>
                        </div>

                    @endif
                    <a href="{{config('variables.privacy_policy_url')}}" target="_blank">View Privacy Policy</a> |
                    <a href="{{config('variables.terms_url')}}" target="_blank">View Terms & Conditions</a>

                </div>
            </div>
        </div>
    </div>

@endsection