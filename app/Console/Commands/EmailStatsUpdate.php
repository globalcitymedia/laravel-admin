<?php

namespace App\Console\Commands;

use App\ScheduleTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EmailStatsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email-stats-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'email-stats-update';

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

        $query = DB::select('  
  SELECT 
    schedule_task_id, 
    COUNT(id) AS total_email_sent ,
    COALESCE(SUM(delivered), 0) AS delivered,
    COALESCE(SUM(opened), 0) AS opened, 
    COALESCE(SUM(bounced), 0) AS bounced, 
    COALESCE(SUM(clicked), 0) AS clicked
  FROM sent_items
  WHERE schedule_task_id IN (SELECT schedule_task_id FROM sent_items WHERE DATEDIFF(updated_at, NOW()) >= -50)
  GROUP BY schedule_task_id');

        foreach ($query as $task):

            DB::select("UPDATE schedule_tasks 
                  SET   total_emails_sent = ".$task->total_email_sent.", 
                        delivered = ".$task->delivered.", 
                        bounced = ".$task->bounced.", 
                        opened = ".$task->opened.", 
                        clicked = ".$task->clicked."  
                  WHERE id =".$task->schedule_task_id);
        endforeach;

    }
}
