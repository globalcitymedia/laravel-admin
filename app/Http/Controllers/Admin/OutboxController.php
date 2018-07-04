<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendNewsletter;
use App\Outbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OutboxController extends Controller
{
    protected $object_name = 'outbox';
    protected $admin_url = '/admin/outbox';

    public function index()
    {
        $outbox = Outbox::paginate(config('variables.paginate_count'));
        $page_title = "Outbox";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        $admin_url = $this->admin_url;

        return view('admin.outbox.index', compact('outbox','page_title','breadcrums','object_name','admin_url'));
    }


    public function sendEmails()
    {
        $outbox = Outbox::orderBy('created_at', 'desc')->limit(2)->get();

        //dd($outbox);
        foreach ($outbox as $item):
            //dump($receiptent);
            $email_to = $item->email;
            $email_to = "elansiva@hotmail.com";
            Mail::to($email_to)->send(new SendNewsletter($item));
            echo $item->email.'<br>';
        endforeach;
    }
}
