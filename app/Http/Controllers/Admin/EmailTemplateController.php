<?php

namespace App\Http\Controllers\Admin;

use App\EmailTemplate;
use App\Http\Requests\EmailTemplateRequest;
use App\Http\Controllers\Controller;
use App\Tracker;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $object_name = 'email-templates';
    protected $admin_url = '/admin/email-templates';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Email Templates";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;

        //$articles = Article::orderby('created_at','desc')->get();
        $list_items = EmailTemplate::paginate(config('variables.paginate_count'));

        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.email_templates.index', compact('list_items', 'page_title', 'object_name', 'breadcrums','admin_url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create new email template";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;
        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.email_templates.create', compact( 'page_title', 'object_name', 'breadcrums','admin_url'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateRequest $request)
    {
        $template = new EmailTemplate($request->all());

        $template->save($template->toArray());

        $tracker = new Tracker();
        $tracker->track('New email temaplte has been created: ' . $request['name']);

        return redirect($this->admin_url);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        $page_title = "Show email template";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;
        $breadcrums = array(['title' => $page_title, 'url' => '']);

        return view('admin.email_templates.show', compact( 'emailTemplate','page_title', 'object_name', 'breadcrums','admin_url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        $page_title = "Edit email template";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;
        $breadcrums = array(['title' => $page_title, 'url' => '']);

        return view('admin.email_templates.edit', compact( 'emailTemplate','page_title', 'object_name', 'breadcrums','admin_url'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->save($request->all());

        $tracker = new Tracker();
        $tracker->track('Email temaplte has been updated: ' . $request['name']);

        return redirect($this->admin_url);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        $tracker = new Tracker();
        $tracker->track('Email template has been deleted: '.$emailTemplate->name);
        return redirect($this->admin_url);
    }
}
