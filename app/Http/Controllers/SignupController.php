<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactAudit;
use App\ContactList;
use App\Http\Requests\SubscriptionRequest;

class SignupController extends Controller
{


    public function glpSubscription()
    {
        $page_title = "Global Legal Post Newsletter Subscription";
        $contact_lists = ContactList::glp()->liveList()->get();
        return view('subscription.glp_new_subscription', compact('contact_lists', 'page_title'));
    }

    public function saveGLPSubscription(SubscriptionRequest $request)
    {
        //dd($request);
        $email = ($request['email']);
        $ex_contact = Contact::where('email', $email)->first();
        $contact_lists = ($request['contact_lists']);
        $msg = '';
//        //glp_promotion
//        if(isset($request['glp_promotion'])):
//            $glp_promotion = ContactList::liveList()->where('name','GLP Promotion')->first()->id;
//            $subscription_list[] = ''.$glp_promotion;
//        endif;
//
//        //glp_thirdparty
//        if(isset($request['glp_thirdparty'])):
//            $glp_thirdparty = ContactList::liveList()->where('name','GLP Third party Promotion')->first()->id;
//            $subscription_list[] = ''.$glp_thirdparty;
//        endif;
        //dd($contact_lists);

        if (is_null($ex_contact)) {
            $request['verification_key'] = str_random(25);
            $request['renewal_date'] = config('variables.renewal_datetime');
            $request['status'] = 1;
            $contact = new  Contact($request->all());
            $contact->signup($contact);
            $contact->contactLists()->syncWithoutDetaching($contact_lists);
            $msg = 'You have successfully signed up to the newsletter!';
        } else {
            //dd($contact_lists);
            $ex_contact->contactLists()->syncWithoutDetaching($contact_lists);
//            return redirect()
//                ->with('success', 'Your email already exist.
//                <a href="' . '/send-manage-preference-email/' . encrypt($ex_contact->verification_key) . '"');
        }

        //dd($request);
        return view('subscription.confirmation', compact('msg'));

    }

    public function subscriptionConfirmation()
    {

        //return "Subscribed successfully";
        //dd(Request::path());
        return view('subscription.confirmation');

    }

    public function verify($verification_key)
    {
        $verified = false;
        //email_verified = verified
        //email_verified = no email send
        //email_verified = email sent

        //$contact = Contact::where([['verification_key','=', $verification_key],['email_verified','!=',"verified"]])->toSql();
        $contact = Contact::where([['verification_key', '=', $verification_key], ['email_verified', '=', 'email sent']])->first();

        //dd($contact);
        if ($contact != null) {

            $tkn = str_random(25);
            $contact->update(['email_verified' => 'verified', 'verification_key' => $tkn]);

            $audit = new ContactAudit();
            $audit->createAudit($contact->id, 'User email verified');
            $verified = true;
            $tkn = encrypt($tkn);
            return view('subscription.verify.email_verified', compact('verified','tkn'));
        }
        return view('subscription.verify.email_verified', compact('verified'));
//        return redirect('/manage-preference/'.encrypt($contact->verification_key))
//            ->with('success', 'Account verified');
    }

    public function verified()
    {
        return view('subscription.email_verified')
            ->with('success', 'Email verified');
    }

}
