<?php

namespace App\Http\Controllers\Admin;

use App\ContactList;
use App\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleTaskRequest;
use App\ScheduleTask;
use Illuminate\Http\Request;

class ScheduleTaskController extends Controller
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
        $page_title = "Schedule Tasks";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;

        //$articles = Article::orderby('created_at','desc')->get();
        $list_items = ScheduleTask::paginate(config('variables.paginate_count'));

        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.schedule_tasks.index', compact('list_items','page_title', 'object_name', 'breadcrums','admin_url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Schedule Tasks";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;

        $email_templates = EmailTemplate::all();
        $contact_lists = ContactList::all();

        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.schedule_tasks.create', compact('email_templates','contact_lists','page_title', 'object_name', 'breadcrums','admin_url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleTaskRequest $request)
    {
        $schdule_task = new ScheduleTask($request->all());

        $schdule_task->save($schdule_task->toArray());


        $tracker = new Tracker();
        $tracker->track('New schedule task has been created: ' . $request['name']);

        return redirect($this->admin_url);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleTask $scheduleTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleTask $scheduleTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleTask $scheduleTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleTask $scheduleTask)
    {
        //
    }
}
