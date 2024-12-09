<?php

namespace App\Http\Controllers\Supervisior;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $usersRepository;
    private $projectRepository;

    public function __construct(UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $this->usersRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index()
    {
        $users = $this->usersRepository->all();
        $projects = $this->projectRepository->getSupervisorProject();
        return view('Supervisior.dashboard' , compact('users', 'projects'));
    }

    public function showProject($id)
    {
        $project = $this->projectRepository->find($id);
        $users = Team::with('user')->where('supervisor_id', Auth::user()->id )->get();
        $tasks = Task::with('user', 'project')->where('supervisor_id', Auth::user()->id )->get();
        return view('Supervisior.manage-project', compact('project','users','tasks'));
    }
}
