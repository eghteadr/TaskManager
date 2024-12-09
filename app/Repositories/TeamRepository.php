<?php

namespace App\Repositories;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class TeamRepository extends BaseRepository
{
    public function __construct(Team $team)
    {
        parent::__construct($team);
    }

    public function selectWithSupervisor($id){
        try {
            return $this->model->select('supervisor_id',$id);
        } catch (\Exception $exception) {
            Log::error('Error in find(): ' . $exception->getMessage(), [
                'id' => $id,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }
}
