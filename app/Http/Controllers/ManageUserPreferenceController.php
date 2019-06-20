<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactList;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;

class ManageUserPreferenceController extends Controller
{

    public function sendManagePreferenceEmail()
    {
        $page_title = "Request Manage Preferences Email";
        return view('subscription.managepreferences.send_manage_preference_email', compact('page_title'));
    }

    public function sendingManagePreferenceEmail(Request $request)
    {
        //validate input
        $this->validate($request, ['email' => 'required|email']);

        $email = $request['email'];

        $contact = Contact::withTrashed()->where('email', $email)->first();

        //dd($contact);

        if ($contact != null):
            $contact->sendManagePreferenceEmail($contact);
            return view('subscription.managepreferences.manage_preference_email_sent');
        else:
            return back()->with('status', 'Email not found');
        endif;
    }


    public function managePreference($tkn)
    {
        $decryptedtkn = decrypt($tkn);
        $contact = Contact::withTrashed()->where('verification_key', $decryptedtkn)->firstOrFail();
//        $tkn = str_random(25);
//        $contact->update(['email_verified' => 'verified', 'verification_key' => $tkn]);
        $contact->update(['email_verified' => 'verified']);
        $contact_lists = ContactList::glp()->liveList()->get();
//        $tkn = encrypt($tkn);
        return view('subscription.managepreferences.manage_preference', compact('contact', 'contact_lists', 'tkn'));
    }



    public function updateManagePreference(SubscriptionRequest $request)
    {
        //dd($request);
        $tkn = $request['tkn'];
        $decryptedtkn = decrypt($tkn);
        //dd($decryptedtkn);
        $contact = Contact::withTrashed()->where('verification_key', $decryptedtkn)->firstOrFail();
        $contact->restore();
        //dd($contact);
        //Change the verification_key
        $request['verification_key'] = str_random(25);
        //Update the contact
        $contact->update($request->all());

        //Update mailing list
        $cl_ids = $request->contact_lists;
        $contact->contactLists()->sync($cl_ids);

        //dd($contact);
        $msg = 'You have successfully updated your newsletter preference!';
        return view('subscription.managepreferences.manage_preference_confirmation', compact('contact', 'contact_lists', 'msg'));
    }



}
