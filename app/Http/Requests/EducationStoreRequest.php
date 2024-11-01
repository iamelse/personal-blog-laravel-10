<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationStoreRequest extends FormRequest
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
            'school_logo_size' => 'nullable|string',
            'school_logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'major' => 'required|string',
            'degree' => 'required|string',
            'school_name' => 'required|string',
            'desc' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ];
    }
}
