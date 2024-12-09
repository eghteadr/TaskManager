<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role_id === '1' ? true : false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'عنوان تسک الزامی است.',
            'title.string' => 'عنوان تسک باید یک رشته معتبر باشد.',
            'title.max' => 'عنوان تسک نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',

            'description.string' => 'توضیحات باید یک رشته معتبر باشد.',

            'deadline.required' => 'مهلت زمانی الزامی است.',
            'deadline.date' => 'مهلت زمانی باید یک تاریخ معتبر باشد.',

            'status.required' => 'وضعیت تسک الزامی است.',
            'status.in' => 'وضعیت انتخاب شده معتبر نیست.',

            'user_id.required' => 'انتخاب سرپرست الزامی است.',
            'user_id.exists' => 'سرپرست انتخاب شده معتبر نیست.',
        ];
    }
}
