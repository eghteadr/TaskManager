<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
class TeamController extends Controller
{
    private $userRepository;
    private $teamRepository;

    public function __construct(UserRepository $userRepository ,TeamRepository $teamRepository){
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
    }

    public function index($id)
    {
        $supervisor = $this->userRepository->find($id);
        $users = $this->userRepository->selectEmp();
        $teamMembers = Team::with('user')->where('supervisor_id', $id )->get();

        return view('admin.create-group', compact('supervisor' , 'users' , 'teamMembers'));
    }

    public function create()
    {
       //
    }

    public function store(StoreTeamRequest $request)
    {
        $createTeam = $this->teamRepository->create($request->validated());
        return redirect()->back()->with(
            $createTeam ? 'success' : 'error',
            $createTeam ? 'کاربر با موفقیت به تیم افزوده شد' : 'عملیات با خطا مواجه شد'
        );
    }

    public function show(Team $team)
    {
        //
    }

    public function edit(Team $team)
    {
        //
    }


    public function update(UpdateTeamRequest $request, Team $team)
    {
        //
    }

    public function destroy($id)
    {
        $deleteTeam = $this->teamRepository->delete($id);
        return redirect()->back()->with(
            $deleteTeam ? 'success' : 'error',
            $deleteTeam ? 'عملیات حذف با موفقیت انجام شد' : 'عملیات با خظا مواجه شد'
        );
    }
}
