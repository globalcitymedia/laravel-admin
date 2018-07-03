<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Outbox;
use App\ScheduleTask;

class DispatchTaskController extends Controller
{
    public function collectScheduledTasks()
    {
        $tasks = ScheduleTask::dispatchable();
        return $tasks;
    }

    public function executeScheduledTasks()
    {
        $tasks = $this->collectScheduledTasks()->get();


        foreach ($tasks as $task):

            $mailinglist = $task->contactLists;
            foreach ($mailinglist as $list):
                $contacts = $list->contacts;
                foreach ($contacts as $contact):

                    //load locked template instance
                    $template = $task->template;

                    $outbox = new Outbox();

                    $outbox['schedule_task_id'] = $task->id;

                    $outbox['locked_email_template_id'] = $template['id'];

                    $outbox['template_name'] = $template['name'];
                    $outbox['subject'] = $template['subject'];
                    $outbox['email_body'] = $template['email_body'];
                    $outbox['from_address'] = $template['from_address'];
                    $outbox['display_name'] = $template['display_name'];

                    $outbox['contact_id'] = $contact->id;
                    $outbox['first_name'] = $contact->first_name;
                    $outbox['last_name'] = $contact->last_name;
                    $outbox['email'] = $contact->email;
                    $outbox['id_key'] = str_random(14);

                    $outbox->save($outbox->toArray());

                endforeach; //$contacts
            endforeach; //$mailinglist

            $task->sent_at = now();

            $task->save();

        endforeach; //$tasks

        return redirect('/admin/schedule-tasks');
    }
}
