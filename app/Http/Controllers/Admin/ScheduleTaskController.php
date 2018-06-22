<?php

namespace App\Http\Controllers\Admin;

use App\ContactList;
use App\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleTaskRequest;
use App\ScheduleTask;
use App\Tracker;
use Illuminate\Http\Request;

class ScheduleTaskController extends Controller
{
    protected $object_name = 'schedule-tasks';
    protected $admin_url = '/admin/schedule-tasks';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Scheduled Tasks";
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
        $page_title = "Create Scheduled Tasks";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;

        $email_templates = array_prepend(EmailTemplate::pluck('name', 'id')->toArray(), 'Please select','0');

        //dd($email_templates);

        $contact_lists = ContactList::all();
        //dd($contact_lists);
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

        //dd($schdule_task);
        $schdule_task->save($schdule_task->toArray());

        $cl_ids = $request->contact_lists;
        $schdule_task->contactLists()->sync($cl_ids);

        $tracker = new Tracker();
        $tracker->track('New schedule task has been created: ');

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
        $page_title = "Edit Scheduled Task";
        $object_name = $this->object_name;
        $admin_url = $this->admin_url;

        $email_templates = array_prepend(EmailTemplate::pluck('name', 'id')->toArray(), 'Please select','0');

        $contact_lists = ContactList::all();

        $breadcrums = array(['title' => $page_title, 'url' => '']);
        //dd($users);
        return view('admin.schedule_tasks.edit', compact('scheduleTask','email_templates','contact_lists','page_title', 'object_name', 'breadcrums','admin_url'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleTaskRequest $request, ScheduleTask $scheduleTask)
    {
        $scheduleTask->update($request->all());

        $cl_ids = $request->contact_lists;
        $scheduleTask->contactLists()->sync($cl_ids);

        $tracker = new Tracker();
        $tracker->track('The schedule task has been updated.');

        return redirect($this->admin_url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleTask  $scheduleTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleTask $scheduleTask)
    {
        $scheduleTask->delete();
        $tracker = new Tracker();
        $tracker->track('Email template has been deleted.');
        return redirect($this->admin_url);
    }
}
