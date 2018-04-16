<?php

namespace App\Http\Controllers\Admin;

use App\ContactList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $object_name = 'contact-lists';
    protected $admin_url = '/admin/contact-lists';

    public function index()
    {
        $page_title = "Contact Lists";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $contact_lists = ContactList::paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.contact_lists.index', compact('contact_lists','page_title','object_name','breadcrums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create new list";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],['title'=>'Create new list', 'url'=>'']);
        return view('admin.contact_lists.create', compact('page_title','object_name','breadcrums'));
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
        $contact_list = new ContactList($request->all());
        //dd($contact_list);
        $contact_list->saveOrFail($contact_list->toArray());

        return redirect($this->admin_url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function show(ContactList $contactList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactList $contactList)
    {
        $page_title = "Edit list";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Contact Lists', 'url'=>'/admin/contact-lists'],['title'=>'Edit list', 'url'=>'']);

        return view('admin.contact_lists.edit', compact('page_title','object_name','breadcrums','contactList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactList $contactList)
    {
        $request['updated_by'] = Auth::user()->id;
        $contactList->update($request->all());

        return redirect($this->admin_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactList  $contactList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactList $contactList)
    {
        $contactList->delete();

        return redirect($this->admin_url);
    }
}
