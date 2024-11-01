<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryUpdateRequest extends FormRequest
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
        $postCategory = $this->route('postCategory');

        return [
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . $postCategory->id,
        ];
    }
}
