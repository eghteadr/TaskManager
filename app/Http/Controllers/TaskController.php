<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;

class TaskController extends Controller
{
    private $taskRepository;
    private $userRepository;

    public function __construct(TaskRepository $taskRepository,
                                UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $tasks = $this->taskRepository->all();
        return view('admin.tasks', compact('tasks'));
    }

    public function create()
    {
        $users = $this->userRepository->selectSopervisior();
        return view('admin.dashboard', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $createTask = $this->taskRepository->create($request->validated());

        return redirect()->back()->with($createTask['success'] ? 'success' : 'error', $createTask['message']);
    }

    public function show($id)
    {
        //TODO after complete supervisor
    }

    public function edit($id)
    {
        $task = $this->taskRepository->find($id);
        $users = $this->userRepository->selectSopervisior();
        return view('admin.tasks-edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $updateTask = $this->taskRepository->update($id, $request->validated());

        return redirect()->back()->with($updateTask['success'] ? 'success' : 'error', $updateTask['message']);
    }

    public function destroy($id)
    {
        $deleteTask = $this->taskRepository->delete($id);

        return redirect()->back()->with($deleteTask['success'] ? 'success' : 'error', $deleteTask['message']);
    }
}
