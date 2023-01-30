<?php

namespace Netberry\TaskManager\Task\Infrastructure\Requests\Laravel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'            => 'required|uuid',
            'name'          => 'required|string|min:3|max:255',
            'categoryIds'   => 'required|array',
            'categoryIds.0'   => 'required|uuid',
        ];
    }
}
