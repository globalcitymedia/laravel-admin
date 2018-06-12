@extends('layouts.subscription')

@section('content')
    <div class="container">
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="alert alert-success newsletter-alert-success ">
                        <h1>You have sucessfully unsubscribed from our mailing list.</h1>
                        <br>

                        {{--<a href="">View your preference</a><br>--}}

                        <p>Global City Media</p>
                        <br>
                        <a href="{{config('variables.privacy_policy_url')}}" target="_blank">Privacy Policy</a> |
                        <a href="{{config('variables.terms_url')}}" target="_blank">Terms & Conditions</a>
                        <a href="/send-email-to-manage-preferences" target="_blank">Manage Subscription</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
