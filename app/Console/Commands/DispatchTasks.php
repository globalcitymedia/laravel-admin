<?php

namespace App\Console\Commands;

use App\Outbox;
use App\ScheduleTask;
use Illuminate\Console\Command;

class DispatchTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduletask:dispatch-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ScheduleTask:dispatchTasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //echo "Hellooooo";
        $tasks = ScheduleTask::dispatchable()->get();

        echo sizeof($tasks);
        foreach ($tasks as $task):

            $mailinglist = $task->contactLists;
            foreach ($mailinglist as $list):
                $contacts = $list->contacts;
                //dd($contacts);
                foreach ($contacts as $contact):
                    //dump($task->id);
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
                    $outbox['id_key'] = $contact->verification_key;

                    $outbox->save($outbox->toArray());

                endforeach; //$contacts
            endforeach; //$mailinglist

            $task->sent_at = now();

            $task->save();

        endforeach; //$tasks
    }
}
