<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactAudit;
use App\ContactList;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;

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


    public function glpSubscription()
    {
        $contact_lists = ContactList::all();
        return view('subscription.new',compact('contact_lists'));
    }

    public function saveGLPSubscription(SubscriptionRequest $request)
    {
        $email =  ($request['email']);
        $ex_contact = Contact::where('email',$email)->first();
        $subscription_list  = $request['contact_lists'];
        dd($subscription_list);
        if(is_null($ex_contact)){
            $contact = new  Contact($request->all());
            $contact->signup($contact->toArray());
        } else {
            $contact_lists =  ($request['contact_lists']);
            $ex_contact->contactLists()->syncWithoutDetaching($contact_lists);
            dd("Alread exist");
        }

        return redirect('/subscription-confirmation');

    }

    public function subscriptionConfirmation(){

        dd(Request::path());
        return view('subscription.confirmation');

    }
}
