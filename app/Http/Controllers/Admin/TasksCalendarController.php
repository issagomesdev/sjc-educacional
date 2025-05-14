<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskTag;

class TasksCalendarController extends Controller
{
    public function index()
    {
        $events = Task::whereNotNull('inicio')->get();
        $taskTags = TaskTag::with(['assinatura', 'team'])->get();

        return view('admin.tasksCalendars.index', compact('events', 'taskTags'));
    }
}
