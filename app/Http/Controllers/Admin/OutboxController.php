<?php

namespace App\Http\Controllers\Admin;

use App\Outbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $outbox = Outbox::orderBy('created_at', 'desc')->limit(10)->get();

        dd($outbox);
    }
}
