<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactList;
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
        $contact_list = ContactList::all();
        $breadcrums = array(['title'=>'Contacts', 'url'=>'/admin/contacts'],['title'=>'Create New Contact', 'url'=>'']);
        return view('admin.contacts.create', compact('page_title','object_name','breadcrums','contact_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;
        $contact = new Contact($request->all());
        //dd($contact);
        $contact->saveOrFail($contact->toArray());

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
        $contact_list = ContactList::all();
        return view('admin.contacts.edit', compact('page_title','object_name','breadcrums','contact','contact_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request['updated_by'] = Auth::user()->id;
        $contact->update($request->all());

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
        $contact->delete();

        return redirect($this->admin_url);
    }
}
