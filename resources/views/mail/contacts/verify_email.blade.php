@component('mail::message')
# Please verify your email address

Welcome {{$name}}!

Thank you for registering to Global City Media Newsletters. Please verify your email address. Just click or tap the button below:

@component('mail::button', ['url' => $url])
    Click here
@endcomponent

Click below to view

<a href="{{config('variables.privacy_policy_url')}}">Privacy Policy</a> |
<a href="{{config('variables.terms_url')}}">Terms & Conditions</a>

Thank you,<br>

The Data Team<br>

Global City Media Ltd<br>
86-90 Paul Street, London, EC2A 4NE, United Kingdom<br>

T: +44 (0) 20 7193 5342<br>
M: +44 (0) 7545 204502<br>
Switchboard: +44 (0) 20 7193 5801<br>
www.globallegalpost.com<br>

@endcomponent
