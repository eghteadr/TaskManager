<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role_id == '1' ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'nullable|date|after:today',
            'status' => [
                'required',
                Rule::in(['pending', 'in_progress', 'completed']),
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'عنوان تسک الزامی است.',
            'description.required' => 'توضیحات تسک الزامی است.',
            'deadline.date' => 'تاریخ مهلت زمانی نامعتبر است.',
            'deadline.after' => 'تاریخ مهلت زمانی باید در آینده باشد.',
            'status.required' => 'وضعیت تسک الزامی است.',
            'status.in' => 'وضعیت تسک باید یکی از مقادیر: pending, in_progress یا completed باشد.',
            'user_id.required' => 'تسک باید به یک کاربر تخصیص داده شود.',
            'user_id.exists' => 'کاربر انتخاب شده معتبر نیست.',
        ];
    }
}
