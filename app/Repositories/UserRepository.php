<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id,array $data){
        return $this->model->update($data,$id);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }

    public function selectSopervisior(){
        try {
            return $this->model->all()->where('role_id','2');
        } catch (\Exception $exception) {
            Log::error('Error in all(): ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }
    public function selectEmp(){
        try {
            return $this->model->all()->where('role_id','3');
        } catch (\Exception $exception) {
            Log::error('Error in all(): ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }
}
