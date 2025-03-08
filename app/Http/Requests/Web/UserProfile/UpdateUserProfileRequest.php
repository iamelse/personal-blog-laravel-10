<?php

namespace App\Http\Requests\Web\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:255',
            'username' => [
                'required',
                'max:255',
                Rule::unique('users', 'username')->ignore($this->route('user'), 'username')
            ],
            'email' => 'required|max:255'
        ];
    }
}
