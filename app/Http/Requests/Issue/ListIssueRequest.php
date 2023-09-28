<?php

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListIssueRequest extends FormRequest
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
