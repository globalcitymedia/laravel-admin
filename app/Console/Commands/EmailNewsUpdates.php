<?php

namespace App\Console\Commands;

use App\Outbox;
use App\SentItem;
use Illuminate\Console\Command;
use App\Mail\SendNewsletter;
use Illuminate\Support\Facades\Mail;

class EmailNewsUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'outbox:send-news-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'outbox:send-news-updates';

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

        $outbox = Outbox::orderBy('id', 'asc')->limit(config('variables.email_per_batch'))->get();
        $sent_mail_ids = array();
        //dd($outbox);
        foreach ($outbox as $item):
            //dump($receiptent);
            $email_to = $item->email;
            //dump($email_to);
            //dd($item->contact_id);
            //$email_to = 'elansiva@hotmail.com';
            if (env('APP_ENV') == 'local'):
                $email_to = env('TEST_EMAIL');
            endif;

             Mail::to($email_to)->send(new SendNewsletter($item));

            $sent_mail_ids[] = $item->id;

            $sentitem = new SentItem();

            $sentitem['schedule_task_id'] = $item->schedule_task_id;
            $sentitem['locked_email_template_id'] = $item->locked_email_template_id;
            $sentitem['contact_id'] = $item->contact_id;
            $sentitem['first_name'] = $item->first_name;
            $sentitem['last_name'] = $item->last_name;
            $sentitem['email'] = $item->email;
            $sentitem['id_key'] = $item->id_key;

            $sentitem->save($sentitem->toArray());

        endforeach;

        Outbox::destroy($sent_mail_ids);
    }

}
