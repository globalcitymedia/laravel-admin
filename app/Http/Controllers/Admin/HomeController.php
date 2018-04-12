<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $page_title = "Dashboard";
        $breadcrums = array(['title'=>'Dashboard', 'url'=>'']);

        return view('admin.home', compact('page_title','breadcrums'));
    }
}
