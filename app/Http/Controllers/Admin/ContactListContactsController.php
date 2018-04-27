<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactList;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Tracker;

class ContactListContactsController extends Controller
{
    protected $object_name = 'contact-lists';
    protected $admin_url = '/admin/contact-lists';

    public function index(ContactList $selected_contact_list)
    {
        //dd($selected_contact_list);
        $page_title = "Contacts in ".$selected_contact_list->name;
        $object_name = $this->object_name;

        $breadcrums = array(
            ['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],
            ['title'=>$selected_contact_list->name, 'url'=>'/admin/contact-lists/'.$selected_contact_list->id],
            ['title'=>'Contacts', 'url'=>'']);

        return view('admin.contact_list_contacts.contacts', compact('page_title','object_name','breadcrums','selected_contact_list'));
    }

    public function create(ContactList $selected_contact_list)
    {
        $page_title = "Create New Contact";
        $object_name = $this->object_name;
        $contact_lists = ContactList::all();
        $breadcrums = array(['title'=>'Contacts', 'url'=>'/admin/contacts'],['title'=>'Create New Contact', 'url'=>'']);
        return view('admin.contact_list_contacts.create', compact('page_title','object_name','breadcrums','contact_lists','selected_contact_list'));

    }

    public function store(ContactRequest $request)
    {
        //$request['created_by'] = Auth::user()->id;
        $request['verification_key'] = str_random(25);
        $request['renewal_date'] = config('variables.renewal_datetime');

        $contact = new Contact($request->all());
        //dd($contact);
        //$contact->saveOrFail($contact->toArray());

        $contact->signup($contact);

        $selected_contact_list_id = $request['selected_contact_list_id'];
        $contact->contactLists()->attach($selected_contact_list_id);

        $tracker = new Tracker();
        $tracker->track('Contact created: '.$request['email']);

        return redirect($this->admin_url.'/'.$selected_contact_list_id.'/contacts');

    }


}
