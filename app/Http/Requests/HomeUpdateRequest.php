<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeUpdateRequest extends FormRequest
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
        $rules = [
            'url' => 'nullable|url',
            'imageInput' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ];

        // Only require 'content' if the action is to update content
        if ($this->route()->getActionMethod() === 'update') {
            $rules['content'] = 'required|string';
        }

        return $rules;
    }
}
