<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'post_category_id' => 'required|exists:post_categories,id',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'body' => 'required',
            'published_at' => 'nullable|date|after:now',
            'status' => 'required|in:published,archive,draft,scheduled',
        ];
    }
}
