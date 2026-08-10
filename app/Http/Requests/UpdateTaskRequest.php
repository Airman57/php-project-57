<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => __('tasks.name_required'),
            'status_id.required' => __('tasks.status_required'),
        ];
    }

    public function attributes(): array
    {
         return [
             'name' => __('task.name'),
             'status_id' => __('task.status')
        ];
    }
}
