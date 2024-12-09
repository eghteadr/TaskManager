<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id|unique:teams,user_id',
            'supervisor_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'وارد کردن شناسه کاربر الزامی است.',
            'user_id.integer' => 'شناسه کاربر باید یک عدد صحیح باشد.',
            'user_id.exists' => 'شناسه کاربر وارد شده در سیستم وجود ندارد.',
            'user_id.unique' => 'این شناسه کاربر قبلاً به یک تیم اختصاص داده شده است.',

            'supervisor_id.required' => 'وارد کردن شناسه سرپرست الزامی است.',
            'supervisor_id.integer' => 'شناسه سرپرست باید یک عدد صحیح باشد.',
            'supervisor_id.exists' => 'شناسه سرپرست وارد شده در سیستم وجود ندارد.',
        ];
    }
}
