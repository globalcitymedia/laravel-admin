<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactAudit;

class SignupController extends Controller
{
    public function verify($verification_key)
    {
        $contact = Contact::where('verification_key', $verification_key)->firstOrFail();

        $contact->update(['verification_key' => null, 'email_verified' => 'yes']);

        $audit = new ContactAudit();
        $audit->createAudit($contact->id,'User verified');

        return redirect()
            ->route('home')
            ->with('success', 'Account verified');
    }

    public function verified()
    {
        return redirect()
            ->route('home')
            ->with('success', 'Account verified');
    }
}
