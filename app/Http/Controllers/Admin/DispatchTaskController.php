<?php

namespace App\Http\Controllers\Admin;

use App\ScheduleTask;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DispatchTaskController extends Controller
{
    public function collectTasks()
    {
        $tasks = ScheduleTask::dispatchable();
        return $tasks;
    }

    public function executeTask()
    {
        $tasks = $this->collectTasks()->get();


        dd($tasks);
    }
}
