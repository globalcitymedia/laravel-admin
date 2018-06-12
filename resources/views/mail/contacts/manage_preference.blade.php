@component('mail::message')
# We would like to stay in touch

Dear {{$name}}

By now, you are likely aware that the on the 25th May 2018 new data privacy laws introduced in Europe called the General Data Protection Regulation (GDPR) will come into force, impacting how businesses collect and process data. To view our privacy policy please click here.

Global City Media Ltd would like to continue to send you by email our news alerts, newsletters, information about our events, publications, research, updates and ideas which we hope are useful to you and to your business.
We want to stay in touch, and hope that you do too.

To continue receiving our emails, simply click on the link below which will take you to the consent form which shows the details we hold about you. Please review the form and submit. We will send you a reminder if we do not hear from you.
@component('mail::button', ['url' => $url])
    Click here
@endcomponent



You can update your email preferences or withdraw your permission to receive our emails at any time by using the relevant links found at the bottom of every email you will receive from us in future.

Thank you,

The Data Team

Global City Media Ltd
London
T: +44 (0) 20 7193 5342

M: +44 (0) 7545 204502
Switchboard: +44 (0) 20 7193 5801
www.globallegalpost.com

@component('mail::button', ['url' => $unsubscribe_url])
    Unsubscribe
@endcomponent

@endcomponent
