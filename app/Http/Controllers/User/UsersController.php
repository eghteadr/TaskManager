<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TaskRepository;

class UsersController extends Controller
{
    private $taskRepository;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        $tasks = Task::with('project')->where('user_id' , Auth::user()->id)->get();
        return view('user.dashboard', compact('tasks'));
    }

    public function showTasks($id)
    {
        $task = Task::with('project')->find($id);
        return view('user.task', compact('task'));
    }

    public function storeTaskTime(Request $request){
        $create = new Time();
        $create->create($request->all());
        return redirect()->back()->with('success-time', 'زمان با موفقیت ثبت شد');
    }
}
