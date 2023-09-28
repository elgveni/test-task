<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListProjectRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'string',
            ],
        ];
    }
}
