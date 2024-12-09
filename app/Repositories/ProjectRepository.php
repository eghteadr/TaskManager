<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectRepository extends BaseRepository
{
    public function __construct(Project $project)
    {
        parent::__construct($project);
    }

    public function getSupervisorProject()
    {
        try {
            return $this->model->all()->where('user_id',Auth::user()->id);
        } catch (\Exception $exception) {
            Log::error('Error in all(): ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }
}
