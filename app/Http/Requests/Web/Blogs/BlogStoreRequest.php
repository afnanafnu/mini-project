<?php

namespace App\Http\Requests\Web\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
                'min:4',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:1024', // 1MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => 'Image size must not exceed 1MB.',
            'image.mimes' => 'Only JPG, JPEG and PNG images are allowed.',
            'content.min' => 'Content must be at least 300 characters.',
        ];
    }
}
