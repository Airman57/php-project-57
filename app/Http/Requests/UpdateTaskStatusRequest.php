<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class UpdateTaskStatusRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => __('task_statuses.name_required'),
        ];
    }

    public function attributes(): array
    {
         return [
             'name' => __('task_statuses.name'),
        ];
    }
}