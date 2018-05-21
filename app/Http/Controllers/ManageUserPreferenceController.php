<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ManageUserPreferenceController extends Controller
{
    public function managePreference($tkn)
    {
        $decryptedtkn = decrypt($tkn);
        $contact = Contact::where('verification_key', $decryptedtkn)->firstOrFail();
        $tkn = str_random(25);
        $contact->update(['email_verified' => 'yes', 'verification_key' => $tkn]);
        $contact_lists = ContactList::glp()->liveList()->get();
        return view('subscription.manage_preference', compact('contact','contact_lists','tkn'));
    }

    public function update($tkn)
    {
        $decryptedtkn = decrypt($tkn);
        $contact = Contact::where('verification_key', $decryptedtkn)->firstOrFail();
        $msg = 'You have successfully updated your newsletter preference!';
        return view('subscription.confrim', compact('contact','contact_lists','msg'));
    }
}
