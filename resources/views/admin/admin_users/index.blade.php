@extends('admin.layouts.skin2')

@section('body')
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th class="hidden-xs">Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row"><a
                            href="/admin/admin_users/{{$user->id}}/edit">{{$user->first_name}} {{$user->last_name}}</a>
                </th>
                <td><a href="/admin/admin_users/{{$user->id}}/edit">{{$user->email}}</a></td>
                <td>
                    <a href="/admin/admin_users/{{$user->id}}/edit">{{$user->getUserStatus($user->status)}}</a>
                </td>
                <td class="hidden-xs">
                    <a href="/admin/admin_users/{{$user->id}}/edit">{{$user->updated_at->diffForHumans()}}</a>
                </td>
                <td>

                    <a href="" onclick="event.preventDefault();
                            document.getElementById('delete_admin_user_form{{$user->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <form action="/admin/admin_users/{{$user->id}}" method="POST"
                          id="delete_admin_user_form{{$user->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $users->links() }}
    </div>





@endsection


<?php

// Modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'path_to_sdk_inclusion';

// Instantiate a new PHPMailer
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$mail->setFrom('sender@example.com', 'Sender Name');

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress('recipient@example.com', 'Recipient Name');

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = 'smtp_username';

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = 'smtp_password';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
$mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$mail->Host = 'email-smtp.us-west-2.amazonaws.com';

// The subject line of the email
$mail->Subject = 'Amazon SES test (SMTP interface accessed using PHP)';

// The HTML-formatted body of the email
$mail->Body = '<h1>Email Test</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>';

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Enable TLS encryption over port 587
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a
// line break.
$mail->AltBody = "Email Test\r\nThis email was sent through the
    Amazon SES SMTP interface using the PHPMailer class.";

if(!$mail->send()) {
    echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
} else {
    echo "Email sent!" , PHP_EOL;
}
?>