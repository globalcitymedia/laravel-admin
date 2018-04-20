<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactAudit;
use Illuminate\Http\Request;

class ContactAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)
    {
       $contactaudit = ContactAudit::where('contact_id',$contact->id)->all();
       dd($contactaudit);
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
