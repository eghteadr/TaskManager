<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Container\Attributes\Log;

class ProjectController extends Controller
{
    private $repository;
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $projects = $this->repository->all();
        return view('admin.projects', compact('projects'));
    }

    public function create()
    {
        //
    }

    public function store(StoreProjectRequest $request)
    {
        $create = $this->repository->create($request->validated());
        return redirect()->back()->with(
            $create ? 'success' : 'failed',
            $create ? 'پروژه با موفقیت ایجاد شد' : 'عملیات با شکست مواجه شد.'
        );

    }

    public function show(Project $project)
    {
       //
    }

    public function edit($id)
    {
        $project = $this->repository->find($id);
        $users = \App\Models\User::where('role_id', 2)->get();
        return view('admin.project-edit', compact('project' ,'users'));
    }


    public function update(UpdateProjectRequest $request, $id)
    {
        $updated = $this->repository->update($id, $request->validated());
        return redirect()->back()->with(
        $updated ? 'success' : 'failed',
        $updated ? 'عملیات بروزرسانی با موفقیت انجام شد ' : 'عملیات با شکست مواجه شد.'
        );
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with(
            $deleted ? 'success' : 'failed',
            $deleted ? 'پروژه با موفقیت حذف شد' : 'عملیات با شکست مواجه شد.'
        );
    }
}
