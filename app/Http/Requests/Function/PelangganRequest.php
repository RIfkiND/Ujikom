<?php

namespace App\Http\Requests\Function;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
           'no_telepon' => 'required|string|max:15|unique:pelanggans,no_telepon',
            'jenis_plg' => 'required|exists:tarifs,id',
        ];
    }
}
