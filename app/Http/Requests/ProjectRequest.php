<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'tags' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ];
    }
}
