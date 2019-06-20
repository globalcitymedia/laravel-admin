<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactList;
use App\Tracker;

class UnsubscribeController extends Controller
{
    public function unsubscribe($tkn)
    {
        $page_title = "Unsubscribe / Manage Preferences";
        $decryptedtkn = decrypt($tkn);

        //dd($decryptedtkn);
        $contact = Contact::withTrashed()->where('verification_key', $decryptedtkn)->firstOrFail();

        $contact_lists = ContactList::liveList()->get();

        //$tkn = encrypt($tkn);
        return view('subscription.unsubscribe.step1', compact('contact', 'contact_lists', 'tkn', 'page_title'));
    }

    public function unsubscribeStep2($tkn)
    {
        $page_title = "Unsubscribe";
        $decryptedtkn = decrypt($tkn);
        $contact = Contact::withTrashed()->where('verification_key', $decryptedtkn)->firstOrFail();

        $tkn = str_random(25);
        $contact->update(['email_verified' => '', 'verification_key' => $tkn]);

        $contact->delete();

        $tracker = new Tracker();
        $tracker->track('User unsubscribed: ' . $contact->email);

        return view('subscription.unsubscribe.confirmation', compact('contact', 'contact_lists', 'tkn', 'page_title'));
    }

    public function destroy(Contact $contact)
    {
        $contact->contactLists()->detach();
        $contact->delete();
        $tracker = new Tracker();
        $tracker->track('Contact deleted: ' . $contact->email);
        return redirect($this->admin_url);
    }



}
