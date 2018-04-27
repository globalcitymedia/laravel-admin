<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\ContactAudit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactAuditController extends Controller
{

    protected $object_name = 'contacts';
    protected $admin_url = '/admin/audits';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)
    {
        $audit = $contact->audit;
        $page_title = "audit trail";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Contacts', 'url'=>'/admin/contacts'],['title'=>$contact->name(), 'url'=>'/admin/contacts/'.$contact->id],['title'=>'audit trail', 'url'=>'']);
        return view('admin.audits.index', compact('audit','page_title','object_name','breadcrums','contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactAudit  $contactAudit
     * @return \Illuminate\Http\Response
     */
    public function show(ContactAudit $contactAudit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactAudit  $contactAudit
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactAudit $contactAudit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactAudit  $contactAudit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactAudit $contactAudit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactAudit  $contactAudit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactAudit $contactAudit)
    {
        //
    }
}
