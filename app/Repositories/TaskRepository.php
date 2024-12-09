<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Task;
use Exception;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        try {
            return $this->model->all();
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'خطا در دریافت تمام تسک‌ها'];
        }
    }

    public function find($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'تسک یافت نشد'];
        }
    }

    public function create(array $data)
    {
        try {
            $task = $this->model->create($data);
            return ['success' => true, 'message' => 'تسک با موفقیت ذخیره شد', 'data' => $task];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'در هنگام ذخیره سازی تسک مشکلی پیش آمده است'];
        }
    }

    public function update($id, array $data)
    {
        try {
            $task = $this->model->findOrFail($id);
            $task->update($data);
            return ['success' => true, 'message' => 'تسک با موفقیت بروزرسانی شد', 'data' => $task];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'در هنگام بروزرسانی تسک مشکلی پیش آمده است'];
        }
    }

    public function delete($id)
    {
        try {
            $task = $this->model->findOrFail($id);
            $task->delete();
            return ['success' => true, 'message' => 'تسک با موفقیت حذف شد'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'در هنگام حذف تسک مشکلی پیش آمده است'];
        }
    }
}
