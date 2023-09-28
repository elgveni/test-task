<?php

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateIssueRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'subject' => [
                'required',
                'string',
                'max:255'
            ],
            'fixed_version_id' => [
                'nullable',
                'integer',
                Rule::exists('versions', 'id'),
            ],
            'is_private' => [
                'nullable',
                'boolean'
            ],
            'project_id' => [
                'nullable',
                'integer',
                Rule::exists('projects', 'id'),
            ],
            'tracker_id' => [
                'nullable',
                'integer',
                Rule::exists('trackers', 'id'),
            ],
            'status_id' => [
                'nullable',
                'integer',
                Rule::exists('statuses', 'id'),
            ],
            'category_id' => [
                'nullable',
                'integer',
                Rule::exists('categories', 'id'),
            ],
            'description' => [
                'nullable',
                'string'
            ],
        ];
    }
}
