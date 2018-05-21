<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactAudit;
use App\ContactList;
use App\Http\Requests\ContactRequest;
use App\Tracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $object_name = 'contacts';
    protected $admin_url = '/admin/contacts';

    public function search(Request $request)
    {

        $page_title = "Search contacts";
        $search = $request['search'];

        $contacts = Contact::search('%'.$search.'%')->paginate(config('variables.paginate_count'));
        //dd($contacts);
        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contacts.index', compact('contacts','page_title','object_name','breadcrums'));
    }

    public function index()
    {
        $page_title = "Contacts";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contacts = Contact::paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contacts.index', compact('contacts','page_title','object_name','breadcrums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New Contact";
        $object_name = $this->object_name;
        $contact_lists = ContactList::all();
        $breadcrums = array(['title'=>'Contacts', 'url'=>'/admin/contacts'],['title'=>'Create New Contact', 'url'=>'']);
        return view('admin.contacts.create', compact('page_title','object_name','breadcrums','contact_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        //$request['created_by'] = Auth::user()->id;
        $request['verification_key'] = str_random(25);
        $request['renewal_date'] = config('variables.renewal_datetime');

        $contact = new Contact($request->all());
        //dd($contact);
        //$contact->saveOrFail($contact->toArray());

        $contact->signup($contact);

        $cl_ids = $request->contact_lists;
        $contact->contactLists()->sync($cl_ids);
        $contact->createAudit($contact->id,"Contact updated by admin". '. Contact list ids: '. implode(" ",$cl_ids),Auth::user()->name());


        $tracker = new Tracker();
        $tracker->track('Contact created: '.$request['email']);

        return redirect($this->admin_url);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $page_title = "Edit list";
        $object_name = $this->object_name;

        $breadcrums = array(['title'=>'Contacts', 'url'=>'/admin/contacts'],['title'=>'Edit list', 'url'=>'']);
        $contact_lists = ContactList::all();

        $audit = $contact->audit;

        return view('admin.contacts.edit', compact('page_title','object_name','breadcrums','contact','contact_lists','audit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $request['updated_by'] = Auth::user()->id;
        $contact->update($request->all());

        $cl_ids = $request->contact_lists;

        $contact->contactLists()->sync($cl_ids);
        $contact->createAudit($contact->id,"Contact updated by admin". '. Contact list ids: '. implode(" ",$cl_ids),Auth::user()->name());
        //dd($contact->contactLists);
        //$contact->contactLists()->attach($cl_ids);
        $tracker = new Tracker();
        $tracker->track('Contact updated: '.$request['email']. '. Contact list ids: '. implode(" ",$cl_ids)  );

        //dd($tra)
        return redirect($this->admin_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->contactLists()->detach();
        $contact->delete();
        $tracker = new Tracker();
        $tracker->track('Contact deleted: '.$contact->email);
        return redirect($this->admin_url);
    }


    public function noEmailSend()
    {
        $page_title = "Contacts: No verification email send";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contacts = Contact::where('email_verified','no email send')->paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contacts.index', compact('contacts','page_title','object_name','breadcrums'));
    }


    public function emailSentNotVerified()
    {
        $page_title = "Contacts: Email Sent Not Verified";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contacts = Contact::where('email_verified','email sent')->paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contacts.index', compact('contacts','page_title','object_name','breadcrums'));
    }


    public function verifiedEmails()
    {
        $page_title = "Contacts: Verified Emails";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contacts = Contact::where('email_verified','verified')->paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contacts.index', compact('contacts','page_title','object_name','breadcrums'));
    }

    public function sendVerificationEmails()
    {
        echo "Send Email";
        $contacts = Contact::where('email_verified','no email send')->limit(2)->get();

        foreach ($contacts as $contact) {
            $contact->sendManagePreferenceEmail($contact);

            $contact->email_verified = 'email sent';

            $contact->save();
        }
        return redirect('/admin/contacts/no-email-send');
    }

}
