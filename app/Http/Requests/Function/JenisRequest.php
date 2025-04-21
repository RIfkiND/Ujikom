<?php

namespace App\Http\Requests\Function;

use Illuminate\Foundation\Http\FormRequest;

class JenisRequest extends FormRequest
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
            'jenis'=> 'required|string|min:1|unique:jenis,name',
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:normal,subsidi',

        ];
    }
}
