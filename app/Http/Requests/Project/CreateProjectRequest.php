<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'default_version_id' => [
                'nullable',
                'integer',
                 Rule::exists('versions', 'id'),
            ],
            'is_public' => [
                'nullable',
                'boolean'
            ],
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('projects', 'id'),
            ],
            'description' => [
                'nullable',
                'string'
            ],
        ];
    }
}
