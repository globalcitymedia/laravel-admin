@extends('layouts.subscription')

@section('content')
    <div class="container">
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="alert alert-success newsletter-alert-success ">
                        <h1>Thank you!</h1>
                        <br>

                        <p>We have sent you an email with a link to
                            manage your newsletter references.</p><br>

                        <a href="{{config('variables.privacy_policy_url')}}">View Privacy Policy</a>
                        <a href="{{config('variables.terms_url')}}">View Terms & Conditions</a>

                        <p>Global City Media</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
