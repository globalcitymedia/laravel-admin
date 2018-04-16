<?php
$page_title = "404 Error";
?>

@extends('layouts.app')

@section('content')
    <section id="contact-address">
        <div class="container">
            <h1>Page Not Found</h1>
        </div>
    </section>
    <!-- Contact Address -->
    <section id="contact-address">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="contact-address-single">
                        <p class="">Copyright &copy; {{config('variables.company_name')}} {{Date('Y')}}</p>
                        <p class="">79 College Road, Harrow, Middlesex, England, HA1 1BD.</p>
                        <p><a href="/en/term-pages/terms-and-conditions">Terms &amp; Conditions</a>&nbsp;| <a href="/en/term-pages/privacy-policy1">Privacy Policy</a></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-address-single">

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-address-single">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./Contact Address -->

@endsection
