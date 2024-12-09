<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        try {
            return $this->model->all();
        } catch (\Exception $exception) {
            Log::error('Error in all(): ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }

    public function find($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $exception) {
            Log::error('Error in find(): ' . $exception->getMessage(), [
                'id' => $id,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->model->create($data);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error in create(): ' . $exception->getMessage(), [
                'data' => $data,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $model = $this->find($id);
            $model->update($data);
            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error in update(): ' . $exception->getMessage(), [
                'id' => $id,
                'data' => $data,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $model = $this->find($id);
            $model->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error in delete(): ' . $exception->getMessage(), [
                'id' => $id,
                'exception' => $exception,
            ]);
            throw $exception;
        }
    }
}
